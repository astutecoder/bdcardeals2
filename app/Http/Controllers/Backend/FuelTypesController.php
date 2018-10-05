<?php

namespace App\Http\Controllers\Backend;

use App\FuelType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuelTypesController extends Controller
{
    public function all_fuel_types(Request $request)
    {
        $fuel_types = FuelType::orderBy('id', 'desc')->withCount('cars')->get();
        if ($fuel_types->isEmpty()) {
            if ($request->ajax()) {
                return response()->json($fuel_types, 204);
            }
            return view('backend.fuelTypes.all_fuel_types')->withErrors(['message' => 'No fuel type found']);
        }

        if ($request->ajax()) {
            return response()->json($fuel_types);
        }
        return view('backend.fuelTypes.all_fuel_types')->with('fuel_types', $fuel_types);
    }

    public function create()
    {
        return view('backend.fuelTypes.add_fuel_type');
    }

    public function store(Request $request)
    {
        $fuel_type_name = $request->input('fuel_type');

        // Validation
        $request->validate([
            'fuel_type' => 'bail|required|unique:fuel_types'
        ], [
            'fuel_type.required' => 'You must type a name for Fuel Type to submit',
            'fuel_type.unique' => 'The type you entered is already taken'
        ]);

        // Inserting data
        $fuel_type = new FuelType();
        $fuel_type->fuel_type = strtolower($fuel_type_name);
        $fuel_type->save();

        // Returning response as json
        if ($request->ajax()) {
            return response()->json($fuel_type->id, 201);
        }
        return redirect()->route('all-fuel-types');
    }

    public function edit($id = null)
    {
        if (!isset($id)) return redirect(404);

        $fuel_type = FuelType::findOrFail($id);

        return view('backend.fuelTypes.edit_fuel_type')->with('fuel_type', $fuel_type);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $fuel_type_name = $request->input('fuel_type');

        $request->validate([
            'fuel_type' => 'bail|required|unique:fuel_types'
        ], [
            'fuel_type.required' => 'You must type a name for Fuel Type to submit',
            'fuel_type.unique' => 'The type you entered is already taken'
        ]);

        $fuel_type = FuelType::findOrFail($id);
        $fuel_type->fuel_type = $fuel_type_name;
        $fuel_type->save();

        return redirect()->route('all-fuel-types');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $fuel_type = FuelType::findOrFail($id);
        $fuel_type->delete();
        return response()->json(1);
    }
}
