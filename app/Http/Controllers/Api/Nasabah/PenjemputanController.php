<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\DetailPenjemputan;
use App\Penjemputan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PenjemputanController extends Controller
{
    public function requestPenjemputan(Request $request,Penjemputan $pj, DetailPenjemputan $d_pj,Carbon $carbon) {
        
        $tanggal = $carbon->now()->toDateString();
        $nasabah_id = Auth::id();
        $pengurus1_id = $request->pengurus1_id;
        $lokasi = $request->lokasi;
        $sampahs = $request->sampah;
        dd($sampahs);

        $old_pj = $pj->where([
            ['tanggal', '=', "{$tanggal}"],
            ['nasabah_id', '=', "{$nasabah_id}"],
            ['pengurus1_id', '=', "{$pengurus1_id}"],
            ['status', '!=', null],
            ['lokasi', '=', "{$lokasi}"],
        ])->first();

        if(empty($old_pj)) {
            $pj = $pj->create([
                'tanggal'       => $tanggal,
                'nasabah_id'    => $nasabah_id,
                'pengurus1_id'  => $pengurus1_id,
                'status'        => 'menunggu',
                'lokasi'        => $lokasi,
            ]);
        } else {
            $pj = $old_pj;
        }

        // return response($pj);
        $old_d_pj = $d_pj->where('penjemputan_id', $pj->id)->first();
        
        if(empty($old_d_pj)) {
            // jika data belum ata, buat data baru
            foreach($sampahs as $sampah) {
                $d_pj->penjemputan_id = $pj->id;
                $d_pj->sampah_id = $sampah['sampah_id'];
                $d_pj->berat = $sampah['berat'];
                // $d_pj->harga =
            }
        }
        
    }
}
