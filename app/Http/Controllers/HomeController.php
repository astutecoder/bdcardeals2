<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use App\Color;
use App\FuelType;
use App\Photo;
use App\Source;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $cars = Car::all()->count();
        $sources = Source::all()->count();
        $brands = Brand::all()->count();
        $colors = Color::all()->count();
        $photos = Photo::all()->count();

        return view('backend.dashboard')
                ->with('cars', $cars)
                ->with('sources', $sources)
                ->with('brands', $brands)
                ->with('colors', $colors)
                ->with('photos', $photos);
    }
}
