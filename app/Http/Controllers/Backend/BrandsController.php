<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function all_brands(Request $request)
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        if ($brands->isEmpty()) {
            if ($request->ajax()) {
                return response()->json($brands, 204);
            }
            return view('backend.brands.all_brands')->withErrors(['message' => 'No brand found']);
        }

        if ($request->ajax()) {
            return response()->json($brands);
        }
        return view('backend.brands.all_brands')->with('brands', $brands);
    }

    public function create()
    {
        return view('backend.brands.add_brand');
    }

    public function store(Request $request)
    {
        $brand_name = $request->input('brand_name');

        // Validation
        $request->validate([
            'brand_name' => 'bail|required|unique:brands'
        ], [
            'brand_name.required' => 'You must type a Brand name to submit',
            'brand_name.unique' => 'The name you entered is already taken'
        ]);

        // Inserting data
        $brand = new Brand();
        $brand->brand_name = strtolower($brand_name);
        $brand->save();

        // Returning response as json
        if ($request->ajax()) {
            return response()->json($brand->id, 201);
        }
        return redirect()->route('all-brands');
    }

    public function edit($id = null)
    {
        if (!isset($id)) return redirect(404);

        $brand = Brand::findOrFail($id);

        return view('backend.brands.edit_brand')->with('brand', $brand);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $brand_name = $request->input('brand_name');

        $request->validate([
                'brand_name' => 'bail|required|unique:brands'
            ], [
                'brand_name.required' => 'You must type a Brand name to submit',
                'brand_name.unique' => 'The name you entered is already taken'
            ]);
        
        $brand = Brand::findOrFail($id);
        $brand->brand_name = $brand_name;
        $brand->save();

        return redirect()->route('all-brands');
    }
}
