<?php

namespace App\Http\Controllers\Backend;

use App\Album;
use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller {

    public function index()
    {
        $albums = Album::withCount(['photos','cars'])->with(['photos'=> function($query){
            $query->where('is_featured','=','1');
        }])->get();

        if ($albums->isEmpty())
        {
            return view('backend.albums.all_albums')->withErrors(['message' => 'No data found']);
        }

        return view('backend.albums.all_albums')->with('albums', $albums);
    }

    public function show()
    {
        return 123;
    }
}
