<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMarkerRequest;
use App\Http\Requests\MarkerUploadVideoRequest;
use App\Http\Requests\UpdateMarkerRequest;
use Illuminate\Support\Facades\Http;

class MarkerUploadController extends Controller
{
    private $paths = [
        'video' => 'https://dev.overlyapp.com/service/upload/video/marker.json'
    ];

    public function video(MarkerUploadVideoRequest $request)
    {
        $data = $request->validated();

        $params = [
            'marker_id' => $data['marker_id'],
            'publish' => 1
        ];

        if(!empty($data['marker_item_id']))
        {
            $params['marker_item_id'] = $data['marker_item_id'];
        }

        $request = Http::withHeaders([
            'ApiKey' => config('overly.SERVICE_KEY')
        ])->attach(
            'video',
            file_get_contents($data['video']->getRealPath()),
            $data['video']->getClientOriginalName()
        )->post($this->paths['video'], $params);

        $resp = json_decode($request->body(), true);
        return response()->json($resp, !empty($resp['c']) ? 200 : 422);
    }

}
