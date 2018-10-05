<?php

namespace App\Http\Controllers\Backend;

use App\Car;
use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        return 123;
    }

    public function create($car_id)
    {
        $album = Album::where('cars_id', $car_id)->get();
        $cars = Car::find($car_id);
        if(!($album->isEmpty())){
            return view('backend.albums.add_album')->withErrors(['message'=> 'An album is already exists for this car']);
        }
        if(!$cars){
            return view('backend.albums.add_album')->withErrors(['message'=> 'Requested car is not in the list']);
        }
        return view('backend.albums.add_album')->with('car_id', $car_id);
    }

    public function store(Request $request)
    {
        $total_img = $request->input('total_files');
        $car_id = $request->input('car_id');
        $success = true;

        $car = Car::findOrFail($car_id);
        $car->brands;
        $folderName = $car->brands->brand_name . '_' . $car->model_no . '_' . $car->year;
        $albumName = strtoupper($car->brands->brand_name) . ' ' . $car->model_no . ' ' . $car->year;

        $file_names = [];

        DB::beginTransaction();
        $album = new Album();
        $album->album_name = $albumName;
        $album->folder_name = $folderName;
        $album->cars_id = $car_id;
        $isAlbumSaved = $album->save();

        if($isAlbumSaved){
            for ($i=0; $i< $total_img; $i++){
                $is_featured = $request->input('feat-'.$i);
                $img = $request->file('img-'.$i);
                $img_name = $img->getClientOriginalName();
                $base_name = pathinfo($img_name, PATHINFO_FILENAME);
                $extension = $img->getClientOriginalExtension();
                $file_name_to_save = $base_name ."_".time()."".$extension;
                $file_names[] = $file_name_to_save;

                $img->storeAs('public/car_albums/'.$folderName, $file_name_to_save);

                $photos = new Photo();
                $photos->file_name = $file_name_to_save;
                $photos->is_featured = $is_featured;
                $photos->cars_id = $car_id;
                $photos->album_id = $album->id;
                $isSaved = $photos->save();

                $success = $isSaved && $success;
            }
        }

        if($success && $isAlbumSaved){
            DB::commit();
            return 1;
        }
        DB::rollBack();
        for($x=0; $x<count($file_names); $x++){
            Storage::delete('public/car_albums/'.$folderName.'/'.$file_names[$x]);
        }
        return 0;
    }

    public function edit($car_id = null){
        $photos = Photo::where('cars_id', $car_id)->get();
        if($photos->isEmpty() || !$car_id){
            return redirect(404);
        }
        return view('backend.albums.edit_album')->with('photos', $photos);
    }

    public function get_all_photos(Request $request, $car_id)
    {
        $photos = Photo::with('albums:id,folder_name')->where('cars_id', $car_id)->get();
        return response()->json($photos);
    }

    public function change_cover(Request $request)
    {
        $image_id =  $request->input('image_id');
        $car_id =  $request->input('car_id');

        $existing_cover = Photo::where(['cars_id'=> $car_id, 'is_featured'=>'1'])->get();
        if(!$existing_cover->isEmpty()){
            $cover_canceled = $existing_cover->first()->update(['is_featured'=>0]);
        }

        if($cover_canceled){
            $new_cover = Photo::findOrFail($image_id);
            $new_cover->is_featured = 1;
            $is_updated = $new_cover->update();
        }

        $result = $is_updated ? 1 : 0;
        return $result;
    }

    public function append_image(Request $request)
    {
        $car_id = $request->input('car_id');
        $album_id = $request->input('album_id');
        $folder_name = $request->input('folder_name');
        $total_image = $request->input('total_image');
        $success = true;

        for($y = 0; $y < $total_image; $y++){
            $img = $request->file('image-'.$y);
            $file_original_name = $img->getClientOriginalName();
            $file_initial = pathinfo($file_original_name, PATHINFO_FILENAME);
            $file_ext = pathinfo($file_original_name, PATHINFO_EXTENSION);
            $file_name = $file_initial . '_' . $y . time() . '.' . $file_ext;

            $photos = new Photo();
            $photos->file_name = $file_name;
            $photos->is_featured = 0;
            $photos->cars_id = $car_id;
            $photos->album_id = $album_id;
            $is_saved = $photos->save();

            $success =$is_saved && $success;

            if($success){
                $img->storeAs('public/car_albums/'.$folder_name, $file_name);
            }
        }
        $result = $success ? 1 : 0;

        return response()->json($result);

    }

    public function delete_image(Request $request)
    {
        $id = $request->input('image_id');
        $folder_name = $request->input('folder_name');

        $image = Photo::findOrFail($id);
        $file_name = $image->file_name;
        DB::beginTransaction();
        $is_deleted = $image->delete();

        if($is_deleted){
            $is_removed = Storage::delete('public/car_albums/'.$folder_name.'/'.$file_name);
        }

        if($is_deleted && $is_removed){
            DB::commit();
        }else{
            DB::rollBack();
        }
        $result = $is_deleted && $is_removed ? 1 : 0;

        return response()->json($result);
    }
}
