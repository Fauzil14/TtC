<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiUserResource extends JsonResource
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
            'hari' => $this->created_at->translatedFormat('l'),
            'tanggal' => $this->created_at->translatedFormat('d M Y'),
            'waktu' => $this->created_at->translatedFormat('H:i'),
            'keterangan_transaksi' => $this->when($this->keterangan_transaksi == 'diantar' || $this->keterengan_trasaksi == 'dijemput', "Penarikan($this->keterangan_transaksi)"),
            'debet' => $this->when($this->keterangan_transaksi == 'diantar' || $this->keterengan_trasaksi == 'dijemput', $this->debet),
            'kredit' => $this->when($this->keterangan_transaksi == 'penarikan', $this->kredit),
        ];
    }
}
