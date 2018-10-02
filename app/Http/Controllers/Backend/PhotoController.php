<?php

namespace App\Http\Controllers\Backend;

use App\Car;
use App\Album;
use App\Photo;
use Doctrine\Common\Lexer\AbstractLexer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    public function index()
    {
        return 123;
    }

    public function create($car_id)
    {
        $album = Album::where('cars_id', $car_id)->get();
        if(!($album->isEmpty())){
            return view('backend.albums.add_album')->withErrors(['message'=> 'An album is already exists for this car']);
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
            Storage::delete($file_names[$x]);
        }
        return 0;
    }
}
