<?php

namespace App\Http\Controllers\Backend;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function all_colors(Request $request)
    {
        $colors = Color::orderBy('id', 'desc')->withCount('cars')->get();
        if ($colors->isEmpty()) {
            if ($request->ajax()) {
                return response()->json($colors, 204);
            }
            return view('backend.colors.all_colors')->withErrors(['message' => 'No color found']);
        }

        if ($request->ajax()) {
            return response()->json($colors);
        }
        return view('backend.colors.all_colors')->with('colors', $colors);
    }

    public function create()
    {
        return view('backend.colors.add_color');
    }

    public function store(Request $request)
    {
        $color_name = $request->input('color_name');

        // Validation
        $request->validate([
            'color_name' => 'bail|required|unique:colors'
        ], [
            'color_name.required' => 'You must type a Color name to submit',
            'color_name.unique' => 'The name you entered is already taken'
        ]);

        // Inserting data
        $color = new Color();
        $color->color_name = strtolower($color_name);
        $color->save();

        // Returning response as json
        if ($request->ajax()) {
            return response()->json($color->id, 201);
        }
        return redirect()->route('all-colors');
    }

    public function edit($id = null)
    {
        if (!isset($id)) return redirect(404);

        $color = Color::findOrFail($id);

        return view('backend.colors.edit_color')->with('color', $color);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $color_name = $request->input('color_name');

        $request->validate([
                'color_name' => 'bail|required|unique:colors'
            ], [
                'color_name.required' => 'You must type a Color name to submit',
                'color_name.unique' => 'The name you entered is already taken'
            ]);
        
        $color = Color::findOrFail($id);
        $color->color_name = $color_name;
        $color->save();

        return redirect()->route('all-colors');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $color = Color::findOrFail($id);
        $color->delete();
        return response()->json(1);
    }
}
