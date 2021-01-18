<?php

namespace App\Http\Controllers\Api;

use App\Sampah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampahResource;

class SampahController extends Controller
{
    
    public function getSampah()
    {
        $sampah = SampahResource::collection(Sampah::get())->groupBy('golongan_sampah_id');

        return $this->sendResponse('succes', 'Samapah data has been succesfully get', $sampah, 200);
    }
}
