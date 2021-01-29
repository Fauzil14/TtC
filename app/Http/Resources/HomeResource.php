<?php

namespace App\Http\Resources;

use App\Bank;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email_verified_at' => $this->email_verified_at,
            'saldo' => $this->tabunganNasabah->first()->saldo,
            'transaksi_terakhir' => new TransaksiUserResource($this->transaksiNasabah->first()),
            'alamat_bank' => Bank::first('alamat_bank'),
        ];
    }
}
