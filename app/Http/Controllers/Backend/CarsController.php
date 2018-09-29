<?php

namespace App\Http\Controllers\Backend;

use App\CarsColor;
use App\CarsFuelType;
use App\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Car;
use App\Brand;
use App\BodyType;
use App\FuelType;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{

    public function all_brands()
    {
        $brands = Brand::all()->each->cars;
        if ($brands->isEmpty()) {
            return response()->json($brands, 204);
        }

        return response()->json($brands);
    }

    public function add_brand(Request $request)
    {
        $brand_name = $request->input('brand_name');

        // Validation
        $request->validate([
            'brand_name' => 'unique:brands'
        ]);

        // Inserting data
        $brand = new Brand();
        $brand->brand_name = strtolower($brand_name);
        $brand->save();

        // Returning response as json
        return response()->json([$brand->id], 201);
    }

    public function all_body_types()
    {
        $body_types = BodyType::all();
        if ($body_types->isEmpty()) {
            return response()->json(['message' => 'No data found'], 204);
        }

        return response()->json($body_types);
    }

    public function add_body_type(Request $request)
    {
        $body_type_name = $request->input('body_type');

        // Validation
        $request->validate([
            'body_type' => 'unique:body_types'
        ]);

        // Inserting data
        $body_type = new BodyType();
        $body_type->body_type = strtolower($body_type_name);
        $body_type->save();

        // Returning response as json
        return response()->json([$body_type->id], 201);
    }


    public function all_fuel_types()
    {
        $fuel_types = FuelType::all();
        if ($fuel_types->isEmpty()) {
            return response()->json(['message' => 'No data found'], 204);
        }

        return response()->json($fuel_types);
    }

    public function add_fuel_type(Request $request)
    {
        $fuel_type_name = $request->input('fuel_type');

        // Validation
        $request->validate([
            'fuel_type' => 'unique:fuel_types'
        ]);

        // Inserting data
        $fuel_type = new FuelType();
        $fuel_type->fuel_type = strtolower($fuel_type_name);
        $fuel_type->save();

        // Returning response as json
        return response()->json([$fuel_type->id], 201);
    }

    public function all_colors()
    {
        $colors = Color::all();
        if ($colors->isEmpty()) {
            return response()->json(['message' => 'No data found'], 204);
        }
        return response()->json($colors);
    }

    public function add_color(Request $request)
    {
        $color_name = $request->input('color_name');

        // Validation
        $request->validate([
            'color_name' => 'required'
        ]);

        // Inserting data
        $color = new Color();
        $color->color_name = $color_name;
        $color->save();

        // Returning response as json
        return response()->json([$color->id], 201);
    }

    public function all_cars()
    {
        $cars = Car::all();
        $cars->each->brands;
        $cars->each->body_types;
        $cars->each->fuel_types;
        $cars->each->colors;

        if ($cars->isEmpty()) {
            return view('backend.cars.all_cars')->withErrors(['message' => 'No data found']);
        }

        return view('backend.cars.all_cars')->with('cars', $cars);
    }

    public function add_car_form()
    {
        $brands = Brand::all();
        $colors = Color::all();
        $body_types = BodyType::all();
        $fuel_types = fuelType::all();
        return view('backend.cars.add_car')
            ->with('brands', $brands)
            ->with('colors', $colors)
            ->with('body_types', $body_types)
            ->with('fuel_types', $fuel_types);
    }

    public function add_car(Request $request)
    {
        $title = $request->input('title');
        $subtitle = $request->input('subtitle');
        $model_no = $request->input('model_no');
        $year = $request->input('year');
        $engine = $request->input('engine');
        $transmission = $request->input('transmission');
        $mileage = $request->input('mileage');
        $doors = $request->input('doors');
        $features = $request->input('features');
        $safety = $request->input('safety');
        $comfort = $request->input('comfort');
        $price = $request->input('price');
        $offer_price = $request->input('offer_price');
        $is_negotiable_price = $request->input('is_negotiable_price') ?? 0;
        $is_featured = $request->input('is_featured') ?? 0;
        $brands_id = $request->input('brands_id');
        $body_types_id = $request->input('body_types_id');
        $fuel_types_id = $request->input('fuel_types_id');
        $colors_id = $request->input('colors_id');
        $save_complete = $request->input('save_complete') ?? 0;

        // Validating Inputs
        $request->validate([
            'model_no' => 'required',
            'year' => 'required|integer|min:4',
            'price' => 'required|integer',
            'brands_id' => 'required',
            'body_types_id' => 'required',
            'fuel_types_id' => 'required',
            'colors_id' => 'required',
        ], [
            'brands_id.required' => 'You must select a Brand',
            'body_types_id.required' => 'You must select a Body Type',
            'fuel_types_id.required' => 'You must select a Fuel Type',
        ]);

        DB::beginTransaction();
        // Storing Cars
        $car = new Car();
        $car->title = $title;
        $car->subtitle = $subtitle;
        $car->model_no = $model_no;
        $car->year = $year;
        $car->engine = $engine;
        $car->transmission = $transmission;
        $car->mileage = $mileage;
        $car->doors = $doors;
        $car->features = $features;
        $car->safety = $safety;
        $car->comfort = $comfort;
        $car->price = $price;
        $car->offer_price = $offer_price;
        $car->is_negotiable_price = $is_negotiable_price;
        $car->is_featured = $is_featured;
        $car->brands_id = $brands_id;
        $car->body_types_id = $body_types_id;
        $car->save_complete = $save_complete;
        $isCarSaved = $car->save();

        // Storing Cars and Fuels id in cars_fuel_types
        $cft = new CarsFuelType();
        $cft->cars_id = $car->id;
        $cft->fuel_types_id = $fuel_types_id;
        $isCarFuelTypeSaved = $cft->save();

        // Storing Cars and Colors id in cars_colors
        $isCarColorSaved = false;
        if (count($colors_id) > 0) {
            $isCarColorSaved = true;
            foreach ($colors_id as $color_id) {
                $cars_colors = new CarsColor();
                $cars_colors->cars_id = $car->id;
                $cars_colors->colors_id = $color_id;
                $isCCSaved = $cars_colors->save();
                $isCarColorSaved = $isCCSaved && $isCarColorSaved;
            }
        }

        if ($isCarSaved && $isCarFuelTypeSaved && $isCarColorSaved) {
            DB::commit();
            return redirect()->route('all-cars');
        } else {
            DB::rollBack();
            return back()->withInput();
        }
    }

    public function edit_car_form($id)
    {
        $car = Car::findOrFail($id);
        $car->brands;
        $car->colors;
        $car->body_types;
        $car->fuel_types;

        $car_colors = [];
        foreach($car->colors as $color){
            $car_colors[] = $color->pivot->colors_id;
        }

        $brands = Brand::all();
        $colors = Color::all();
        $body_types = BodyType::all();
        $fuel_types = FuelType::all();

        return view('backend.cars.edit_car')
                    ->with('car', $car)
                    ->with('car_colors', $car_colors)
                    ->with('brands', $brands)
                    ->with('colors', $colors)
                    ->with('body_types', $body_types)
                    ->with('fuel_types', $fuel_types);
    }

    public function update_car(Request $request) {
        $title = $request->input('title');
        $subtitle = $request->input('subtitle');
        $model_no = $request->input('model_no');
        $year = $request->input('year');
        $engine = $request->input('engine');
        $transmission = $request->input('transmission');
        $mileage = $request->input('mileage');
        $doors = $request->input('doors');
        $features = $request->input('features');
        $safety = $request->input('safety');
        $comfort = $request->input('comfort');
        $price = $request->input('price');
        $offer_price = $request->input('offer_price');
        $is_negotiable_price = $request->input('is_negotiable_price') ?? 0;
        $is_featured = $request->input('is_featured') ?? 0;
        $brands_id = $request->input('brands_id');
        $body_types_id = $request->input('body_types_id');
        $fuel_types_id = $request->input('fuel_types_id');
        $colors_id = $request->input('colors_id');
        $save_complete = $request->input('save_complete') ?? 0;

        // Validating Inputs
        $request->validate([
            'model_no' => 'required',
            'year' => 'required|integer|min:4',
            'price' => 'required|integer',
            'brands_id' => 'required',
            'body_types_id' => 'required',
            'fuel_types_id' => 'required',
            'colors_id' => 'required',
        ], [
            'brands_id.required' => 'You must select a Brand',
            'body_types_id.required' => 'You must select a Body Type',
            'fuel_types_id.required' => 'You must select a Fuel Type',
        ]);

        DB::beginTransaction();
        // Storing Cars
        $car = new Car();
        $car->title = $title;
        $car->subtitle = $subtitle;
        $car->model_no = $model_no;
        $car->year = $year;
        $car->engine = $engine;
        $car->transmission = $transmission;
        $car->mileage = $mileage;
        $car->doors = $doors;
        $car->features = $features;
        $car->safety = $safety;
        $car->comfort = $comfort;
        $car->price = $price;
        $car->offer_price = $offer_price;
        $car->is_negotiable_price = $is_negotiable_price;
        $car->is_featured = $is_featured;
        $car->brands_id = $brands_id;
        $car->body_types_id = $body_types_id;
        $car->save_complete = $save_complete;
        $isCarSaved = $car->save();

        // Storing Cars and Fuels id in cars_fuel_types
        $cft = new CarsFuelType();
        $cft->cars_id = $car->id;
        $cft->fuel_types_id = $fuel_types_id;
        $isCarFuelTypeSaved = $cft->save();

        // Storing Cars and Colors id in cars_colors
        $isCarColorSaved = false;
        if (count($colors_id) > 0) {
            $isCarColorSaved = true;
            foreach ($colors_id as $color_id) {
                $cars_colors = new CarsColor();
                $cars_colors->cars_id = $car->id;
                $cars_colors->colors_id = $color_id;
                $isCCSaved = $cars_colors->save();
                $isCarColorSaved = $isCCSaved && $isCarColorSaved;
            }
        }

        if ($isCarSaved && $isCarFuelTypeSaved && $isCarColorSaved) {
            DB::commit();
            return redirect()->route('all-cars');
        } else {
            DB::rollBack();
            return back()->withInput();
        }
    }
}
