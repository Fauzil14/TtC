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
        $tabunganNasabah = $this->tabunganNasabah->first();
        $transaksiTerakhir = new TransaksiUserResource($this->transaksiNasabah->first());

        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'email_verified_at'  => $this->email_verified_at,
            'saldo'              => $tabunganNasabah ? $tabunganNasabah->saldo : 0,
            'transaksi_terakhir' => $transaksiUser ?? "Anda belum melakukan transaksi apapun.",
            'alamat_bank'        => Bank::first()->alamat_bank,
        ];
    }
}
