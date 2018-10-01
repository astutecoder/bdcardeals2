<?php

namespace App\Http\Controllers\Backend;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index()
    {
        return 123;
    }

    public function create($car_id)
    {
        return view('backend.albums.add_album')->with('car_id', $car_id);
    }

    public function store(Request $request)
    {
        $total_img = $request->input('total_files');
        $car_id = $request->input('car_id');
        $success = true;

        $car = Car::findOrFail($car_id);
        $car->each->brands;
        $folderName = $car->brands->brand_name;
        $folderName .= $car->model_no;
        $folderName .= $car->year;
        return $folderName;

//        DB::beginTransaction();
//        for ($i=0; $i< $total_img; $i++){
//            $img = $request->file('img-'.$i);
//            $img_name = $img->getClientOriginalName();
//            $base_name = pathinfo($img_name, PATHINFO_FILENAME);
//            $extention = $img->getClientOriginalExtension();
//            $file_name_to_save = $base_name ."_".time()."".$extention;
//
//            $img->storeAs('public/')
//        }
//        return;
    }
}
