<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusRequest = $request->input("status");
        $response = Http::get(config('constants.base_url') . '/pet/findByStatus?status=' . $statusRequest);
        $pets = $response->json();
        
        
        return view('pet.index', compact('pets', 'statusRequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:75',
            'name' => 'required|string|max:75',
            'photoUrls' => 'array',
            'photoUrls.*' => 'string|max:350',
            'tags' => 'array',
            'tags.*' => 'string|max:75',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach($request->tags as $tag) {
            $tags[] = array(
                'name' => $tag
            );
        };

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json'
        ])->post(config('constants.base_url') . '/pet', [
            'category' => [
                'name' => $request->category
            ],
            'name' => $request->name,
            'photoUrls' => $request->photoUrls,
            'tags' => $tags,
            'status' => $request->status
        ]);

        if ($response->successful()) {
            return redirect("/pets?status=" . $request->status)->with('success', 'Pet ' . $request->name .  ' was created successfully!');
        } else {
            return redirect("/pets?status=" . $request->status)->with('error', 'Failed to create pet ' . $request->name . '. Please try again.');
        }

        // if ($response->status()) {
        //     return redirect("/pets?status=" . $request->status);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete pet
        $response = Http::delete(config('constants.base_url') . '/pet/' . $id);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet ' . $id .  ' deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete pet ' . $id . '. Please try again.');
        }
    }
}
