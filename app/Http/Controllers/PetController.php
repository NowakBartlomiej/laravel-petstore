<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $petService = new PetService();

        $statusRequest = $request->input("status");
        $response = $petService->getPetsByStatus($statusRequest);
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
    public function store(StorePetRequest $request)
    {
        $petService = new PetService();
        $response = $petService->storePet($request);
        
        if ($response->successful()) {
            return redirect("/pets?status=" . $request->status)->with('success', 'Pet ' . $request->name .  ' was created successfully!');
        } else {
            return redirect("/pets?status=" . $request->status)->with('error', 'Failed to create pet ' . $request->name . '. Please try again.');
        }
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
    public function edit($id)
    {
        $petService = new PetService();
        $response = $petService->getPetById($id);

        $pet = $response->json();

        if ($response->successful()) {
            return view('pet.edit', ['pet' => $pet]);
        } else {
            return redirect()->back()->with('error', 'Failed to update pet. Pet is probably deleted');
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, $id)
    {
        $petService = new PetService();
        $response = $petService->updatePet($request, $id);
        
        if ($response->successful()) {
            return redirect("/pets?status=" . $request->status)->with('success', 'Pet ' . $request->name .  ' was updated successfully!');
        } else {
            return redirect("/pets?status=" . $request->status)->with('error', 'Failed to update pet ' . $request->name . '. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $petService = new PetService();
        $response = $petService->deletePet($id);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pet ' . $id .  ' deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete pet ' . $id . '. Please try again.');
        }
    }
}
