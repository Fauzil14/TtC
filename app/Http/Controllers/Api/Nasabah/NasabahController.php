<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\TabunganUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TabuganNasabahResource;

class NasabahController extends Controller
{

    public function getTabungan()
    {
        $tabungan = TabuganNasabahResource::collection(TabunganUser::orderByDesc('id')->where('nasabah_id', Auth::id())->get());

        return $this->sendResponse('succes', 'Data tabungan succesfully get', $tabungan, 200);
    }
}
