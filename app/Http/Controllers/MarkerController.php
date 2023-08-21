<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMarkerRequest;
use App\Http\Requests\UpdateMarkerRequest;
use Illuminate\Support\Facades\Http;

class MarkerController extends Controller
{
    private $paths = [
        'create' => 'https://dev.overlyapp.com/service/marker/create.json',
        'update' => 'https://dev.overlyapp.com/service/marker/update.json'
    ];

    public function create(CreateMarkerRequest $request)
    {
        $data = $request->validated();

        $request = Http::withHeaders([
            'ApiKey' => config('overly.SERVICE_KEY')
        ])->attach(
            'image',
            file_get_contents($data['image']->getRealPath()),
            $data['image']->getClientOriginalName()
        )->post($this->paths['create'], [
            'name' => $data['name'],
            'project_id' => $data['project_id'],
        ]);

        $resp = json_decode($request->body(), true);
        return response()->json($resp, !empty($resp['c']) ? 200 : 422);
    }

    public function update(UpdateMarkerRequest $request)
    {
        $data = $request->validated();

        $request = Http::withHeaders([
            'ApiKey' => config('overly.SERVICE_KEY')
        ])->attach(
            'image',
            file_get_contents($data['image']->getRealPath()),
            $data['image']->getClientOriginalName()
        )->post($this->paths['create'], [
            'name' => $data['name'],
            'project_id' => $data['project_id'],
            'marker_id' => $data['marker_id']
        ]);

        $resp = json_decode($request->body(), true);
        return response()->json($resp, !empty($resp['c']) ? 200 : 422);
    }


}
