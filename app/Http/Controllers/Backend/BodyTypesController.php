<?php

namespace App\Http\Controllers\Backend;

use App\BodyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BodyTypesController extends Controller
{
    public function all_body_types(Request $request)
    {
        $body_types = BodyType::orderBy('id', 'desc')->get();
        if($body_types->isEmpty()){
            if($request->ajax()){
                return response()->json($body_types, 204);
            }
            return view('backend.bodyTypes.all_body_types')->withErrors(['message'=>'No body types are available to show']);
        }

        if($request->ajax()){
            return response()->json($body_types);
        }
        return view('backend.bodyTypes.all_body_types')->with('body_types', $body_types);
    }

    public function create()
    {
        return view('backend.bodyTypes.add_body_type');
    }

    public function store(Request $request)
    {
        $body_type = $request->input('body_type');

        // Validation
        $request->validate([
            'body_type' => 'bail|required|unique:body_types'
        ], [
            'body_type.required' => 'You must type a name for Body Type to submit',
            'body_type.unique' => 'The type you entered is already taken'
        ]);

        // Inserting data
        $body_type = new BodyType();
        $body_type->body_type = strtolower($body_type);
        $body_type->save();

        // Returning response as json
        if ($request->ajax()) {
            return response()->json($body_type->id, 201);
        }
        return redirect()->route('all-body-types');
    }

    public function edit($id = null)
    {
        if (!isset($id)) return redirect(404);

        $body_type = BodyType::findOrFail($id);

        return view('backend.bodyTypes.edit_body_type')->with('body_type', $body_type);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $body_type = $request->input('body_type');

        $request->validate([
            'body_type' => 'bail|required|unique:body_types'
        ], [
            'body_type.required' => 'You must type a Body Type name to submit',
            'body_type.unique' => 'The name you entered is already taken'
        ]);

        $bodytype = BodyType::findOrFail($id);
        $bodytype->body_type = $body_type;
        $bodytype->save();

        return redirect()->route('all-body-types');
    }
}
