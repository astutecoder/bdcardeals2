<?php

namespace App\Http\Controllers\Backend;

use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourcesController extends Controller
{
    public function all_sources(Request $request)
    {
        $sources = Source::orderBy('id', 'desc')->get();
        if ($sources->isEmpty()) {
            if ($request->ajax()) {
                return response()->json($sources, 204);
            }
            return view('backend.sources.all_sources')->withErrors(['message' => 'No source found']);
        }

        if ($request->ajax()) {
            return response()->json($sources);
        }
        return view('backend.sources.all_sources')->with('sources', $sources);
    }

    public function create()
    {
        return view('backend.sources.add_source');
    }

    public function store(Request $request)
    {
        $source_name = $request->input('source_name');
        $source_code = $request->input('source_code');
        $contact = $request->input('contact');
        $email = $request->input('email');
        $address = $request->input('address');

        // Validation
        $request->validate([
            'source_code' => ['bail','required','unique:sources'],
            'contact' => ['bail','required','regex:/^(\+88|0088)?0[1-9][0-9]{9}$/'],
            'email' => ['nullable','regex:/^[a-z0-9\_\.]{3,}\@[a-z0-9]{2,}\.[a-z]{2,6}(\.[a-z]{2,6})?$/'],
        ], [
            'source_code.required' => 'You must type a Source Code to submit',
            'source_code.unique' => 'The code you entered is already taken',
            'contact.required' => 'The must enter a phone number'
        ]);

        // Inserting data
        $source = new Source();
        $source->source_name = strtolower($source_name);
        $source->source_code = strtolower($source_code);
        $source->contact = strtolower($contact);
        $source->email = strtolower($email);
        $source->address = $address;
        $source->save();

        // Returning response as json
        if ($request->ajax()) {
            return response()->json($source->id, 201);
        }
        return redirect()->route('all-sources');
    }

    public function edit($id = null)
    {
        if (!isset($id)) return redirect(404);

        $source = Source::findOrFail($id);

        return view('backend.sources.edit_source')->with('source', $source);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $source_name = $request->input('source_name');
        $source_code = $request->input('source_code');
        $contact = $request->input('contact');
        $email = $request->input('email');
        $address = $request->input('address');

        // Validation
        $request->validate([
            'source_code' => ['bail','required','unique:sources'],
            'contact' => ['bail','required','regex:/^(\+88|0088)?0[1-9][0-9]{9}$/'],
            'email' => ['nullable','regex:/^[a-z0-9\_\.]{3,}\@[a-z0-9]{2,}\.[a-z]{2,6}(\.[a-z]{2,6})?$/'],
        ], [
            'source_code.required' => 'You must type a Source Code to submit',
            'source_code.unique' => 'The code you entered is already taken',
            'contact.required' => 'The must enter a phone number'
        ]);

        // Inserting data
        $source = Source::findOrFail($id);
        $source->source_name = strtolower($source_name);
        $source->source_code = strtolower($source_code);
        $source->contact = strtolower($contact);
        $source->email = strtolower($email);
        $source->address = $address;
        $source->save();

        // Returning response as json
        if ($request->ajax()) {
            return response()->json($source->id, 201);
        }
        return redirect()->route('all-sources');
    }
}
