<?php

namespace App\Services;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PetService {
    public function mapTags($requestTags) {
        foreach($requestTags as $tag) {
            $tags[] = array(
                'name' => $tag
            );
        };

        return $tags;
    }

    public function getPetsByStatus($status) {
        return Http::get(config('constants.base_url') . '/pet/findByStatus?status=' . $status);
    }

    public function storePet(StorePetRequest $request) {
        $tags = $this->mapTags($request->tags);
        
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
        
        return $response;
    }

    public function getPetById($id) {
        return Http::get(config('constants.base_url') . '/pet/' . $id);
    }

    public function updatePet(UpdatePetRequest $request, $id) {
        $tags = $this->mapTags($request->tags);

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->put(config('constants.base_url') . '/pet', [
            'id' => $id,
            'category' => [
                'name' => $request->category
            ],
            'name' => $request->name,
            'photoUrls' => $request->photoUrls,
            'tags' => $tags,
            'status' => $request->status
        ]);

        return $response;
    }

    public function deletePet($id) {
        return Http::delete(config('constants.base_url') . '/pet/' . $id);
    }
}