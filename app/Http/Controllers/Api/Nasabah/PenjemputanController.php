<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\DetailPenjemputan;
use App\Penjemputan;
use App\Sampah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PenjemputanController extends Controller
{
    public function requestPenjemputan(Request $request,Penjemputan $pj, DetailPenjemputan $d_pj, Carbon $carbon, Sampah $tabel_sampah) {
        
        $tanggal = $carbon->now()->toDateString();
        $nasabah_id = Auth::id();
        $pengurus1_id = $request->pengurus1_id;
        $lokasi = $request->lokasi;
        $sampahs = $request->sampah;

        $old_pj = $pj->firstOrCreate([
            'tanggal'       => $tanggal,
            'nasabah_id'    => $nasabah_id,
            'pengurus1_id'  => $pengurus1_id,
            'status'        => 'menunggu',
            'lokasi'        => $lokasi,
        ]);


        foreach($sampahs as $sampah) {
            $harga = $tabel_sampah->firstWhere('id', "{$sampah['sampah_id']}");
            $harga_j = $harga->harga_perkilogram - ($harga->harga_perkilogram * 0.2);
            $old_d_pj = $d_pj->firstWhere([ 
                                            'penjemputan_id' => $old_pj->id,
                                            'sampah_id'      => $sampah['sampah_id'],
                                          ]);
            $d_pj->updateOrCreate([
                                   'penjemputan_id' => $old_pj->id,
                                   'sampah_id'      => $sampah['sampah_id'],
                                  ],
                                  [
                                   'berat'          => empty($old_d_pj) ? $sampah['berat'] : $old_d_pj->berat + $sampah['berat'],
                                   'harga'          => $harga_j,
                                  ]);
        }
        
        $old_pj->update([
            'total_berat' => $d_pj->where('penjemputan_id', $old_pj->id)->sum('berat'),
            'total_harga' => $d_pj->where('penjemputan_id', $old_pj->id)->sum('harga'),
        ]);
        
        $data = $pj->where('id', $old_pj->id)->with('detail_penjemputan')->get();
        return $this->sendResponse('succes', 'Pickup request sent successfully', $data, 201);
        
    }
}
