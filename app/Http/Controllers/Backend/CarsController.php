<?php

namespace App\Http\Controllers\Backend;

use App\Album;
use App\CarsColor;
use App\CarsFuelType;
use App\Color;
use App\Photo;
use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Car;
use App\Brand;
use App\BodyType;
use App\FuelType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarsController extends Controller
{
    /**
     * finds all the cars and it's related data
     * process it for api response
     * or send back a view
     * @return $this
     */
    public function all_cars(Request $request)
    {
//        $cars = Car::with(['brands', 'fuel_types', 'body_types', 'colors', 'sources'])->orderBy('id', 'desc')->get();
//        return response()->json($cars);

        $cars = Car::orderBy('id', 'desc')->get();
        $cars->each->brands;
        $cars->each->body_types;
        $cars->each->fuel_types;
        $cars->each->colors;
        $cars->each->sources;
        $cars->each->albums;
        $cars->each->photos;

        if($request->wantsJson()){
            if($cars->isEmpty()){
                return response()->json([], 204);
            }
            return response()->json($cars);
        }

        if ($cars->isEmpty()) {
            return view('backend.cars.all_cars')->withErrors(['message' => 'No data found']);
        }

//        return response()->json($cars);
        return view('backend.cars.all_cars')->with('cars', $cars);
    }

    public function get_single_car($id){
        if((int)($id) == 0){
            return response()->json('Not found', 404);
        }
        $car = Car::findOrFail($id);
        $car->brands;
        $car->body_types;
        $car->fuel_types;
        $car->colors;
        $car->sources;
        $car->albums;
        $car->photos;
        return response()->json($car);
    }

    public function show($id)
    {
        $car = Car::withCount('photos', 'albums', 'colors')->findOrFail($id);
        $brands = Brand::all();
        $colors = Color::all();
        $body_types = BodyType::all();
        $fuel_types = FuelType::all();
        $sources = Source::all();

        $car_colors = [];
        foreach ($car->colors as $color) {
            $car_colors[] = $color->pivot->colors_id;
        }
//        return $car;
        return view('backend.cars.single_car')
            ->with('car', $car)
            ->with('brands', $brands)
            ->with('colors', $colors)
            ->with('car_colors', $car_colors)
            ->with('body_types', $body_types)
            ->with('fuel_types', $fuel_types)
            ->with('sources', $sources);
    }

    public function create()
    {
        $brands = Brand::all();
        $colors = Color::all();
        $body_types = BodyType::all();
        $fuel_types = FuelType::all();
        $sources = Source::all();

        return view('backend.cars.add_car')
            ->with('brands', $brands)
            ->with('colors', $colors)
            ->with('body_types', $body_types)
            ->with('fuel_types', $fuel_types)
            ->with('sources', $sources);
    }

    public function store(Request $request)
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
        $source_id = $request->input('source_id');
        $car_condition = $request->input('car_condition');
        $colors_id = $request->input('colors_id');
        $save_complete = $request->input('save_complete') ?? 0;

        // Validating Inputs
        $request->validate([
            'model_no' => 'required',
            'year' => ['required', 'min:4', 'regex:/^\d+$/'],
            'price' => ['required', 'regex:/^\d+$/'],
            'offer_price' => ['nullable', 'regex:/^\d+$/'],
            'brands_id' => 'required',
            'body_types_id' => 'required',
            'fuel_types_id' => 'required',
            'source_id' => 'required',
            'car_condition' => 'required',
            'colors_id' => 'required',
            'engine' => 'required',
            'transmission' => 'required',
            'mileage' => 'required',
        ], [
            'brands_id.required' => 'You must select a Brand',
            'body_types_id.required' => 'You must select a Body Type',
            'fuel_types_id.required' => 'You must select a Fuel Type',
            'source_id.required' => 'You must select a Source',
            'car_condition.required' => 'You must select a Condition',
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
        $car->source_id = $source_id;
        $car->car_condition = $car_condition;
        $car->save_complete = $save_complete;
        $isCarSaved = $car->save();

        // Storing Cars and Fuels id in cars_fuel_types
        $cft = new CarsFuelType();
        $cft->cars_id = $car->id;
        $cft->fuel_types_id = $fuel_types_id;
        $isCarFuelTypeSaved = $cft->save();

        // Storing Cars and Colors id in cars_colors
        $isCarColorSaved = FALSE;
        if (count($colors_id) > 0) {
            $isCarColorSaved = TRUE;
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

    public function edit($id = NULL)
    {
        if (!isset($id)) return redirect(404);

        $car = Car::findOrFail($id);
        $car->brands;
        $car->colors;
        $car->body_types;
        $car->fuel_types;
        $car->sources;

        $car_colors = [];
        foreach ($car->colors as $color) {
            $car_colors[] = $color->pivot->colors_id;
        }

        $brands = Brand::all();
        $colors = Color::all();
        $body_types = BodyType::all();
        $fuel_types = FuelType::all();
        $sources = Source::all();

        return view('backend.cars.edit_car')
            ->with('car', $car)
            ->with('car_colors', $car_colors)
            ->with('brands', $brands)
            ->with('colors', $colors)
            ->with('body_types', $body_types)
            ->with('fuel_types', $fuel_types)
            ->with('sources', $sources);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
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
        $source_id = $request->input('source_id');
        $car_condition = $request->input('car_condition');
        $colors_id = $request->input('colors_id');
        $save_complete = $request->input('save_complete') ?? 0;
        $updated_at = $request->input('updated_at') ?? 0;

//        print_r($subtitle); return;

        // Validating Inputs
        $request->validate([
            'model_no' => 'required',
            'year' => ['required', 'min:4', 'regex:/^\d+$/'],
            'price' => ['required', 'regex:/^\d+$/'],
            'offer_price' => ['nullable', 'regex:/^\d+$/'],
            'brands_id' => 'required',
            'body_types_id' => 'required',
            'fuel_types_id' => 'required',
            'source_id' => 'required',
            'colors_id' => 'required',
            'car_condition' => 'required',
            'engine' => 'required',
            'transmission' => 'required',
            'mileage' => 'required',
        ], [
            'brands_id.required' => 'You must select a Brand',
            'body_types_id.required' => 'You must select a Body Type',
            'fuel_types_id.required' => 'You must select a Fuel Type',
            'source_id.required' => 'You must select a Source',
            'car_condition.required' => 'You must select a Condition',
        ]);

//        DB::beginTransaction();
        // Updating Car
        $car = Car::findOrFail($id);
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
        $car->source_id = $source_id;
        $car->car_condition = $car_condition;
        $car->save_complete = $save_complete;
        $isCarUpdated = $car->save();

//        return $isCarUpdated? 'isCarUpdated true':'isCarUpdated false';

        // Updating Cars and Fuels id in cars_fuel_types
        $cft = CarsFuelType::where('cars_id', $id)->first();
        $cft->cars_id = $id;
        $cft->fuel_types_id = $fuel_types_id;
        $isCarFuelTypeUpdated = $cft->save();

//        return $isCarFuelTypeUpdated? 'isCarFuelTypeUpdated true':'isCarFuelTypeUpdated false';

        // Updating Cars and Colors id in cars_colors
        $isCarColorUpdated = FALSE;
        if (count($colors_id) > 0) {
            $isCarColorUpdated = TRUE;
            $cc = CarsColor::where('cars_id', $id)->delete();
            foreach ($colors_id as $color_id) {
                $cars_colors = new CarsColor();
                $cars_colors->cars_id = $id;
                $cars_colors->colors_id = $color_id;
                $isCCUpdated = $cars_colors->save();
                $isCarColorUpdated = $isCCUpdated && $isCarColorUpdated;
            }
        }
//        return $isCarColorUpdated? 'isCarColorUpdated true':'isCarColorUpdated false';

        if ($isCarUpdated && $isCarFuelTypeUpdated && $isCarColorUpdated) {
            DB::commit();

            return redirect()->route('all-cars');
        } else {
            DB::rollBack();

            return back()->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $success = true;

        DB::beginTransaction();
        // deleting photos
        $photos = Photo::where('cars_id', $id)->get();
        if(!$photos->isEmpty()){
            $photosDeleted = Photo::where('cars_id', $id)->delete();
            $success = $success && $photosDeleted;
        }

        // deleting albums and removing folder
        $album = Album::where('cars_id', $id)->get();
        if(!$album->isEmpty()){
            $folder_name = $album->first()->folder_name;
            Storage::deleteDirectory('public/car_albums/' . $folder_name);
            $albumDeleted = Album::where('cars_id', $id)->delete();
            $success = $success && $albumDeleted;
        }

        // deleting car-colors
        $colorDeleted = CarsColor::where('cars_id', $id)->delete();
        $success = $success && $colorDeleted;

        // deleting car-fuel-types
        $fuelDeleted = CarsFuelType::where('cars_id', $id)->delete();
        $success = $success && $fuelDeleted;

        // deleting cars
        $car = Car::find($id);
        $carDeleted = $car->delete();
        $success = $success && $carDeleted;

        if ($success) {
            DB::commit();
            return response()->json(1);
        }
        DB::rollBack();
        return response()->json(0);

    }
}
