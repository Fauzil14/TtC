<?php

namespace App\Http\Controllers\Api\PengurusSatu;

use App\Sampah;
use Carbon\Carbon;
use App\Penyetoran;
use App\Penjemputan;
use App\DetailPenyetoran;
use App\DetailPenjemputan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenyetoranController extends Controller
{
    public function showNasabahRequest(Penjemputan $pj) 
    {
        $data = $pj->where('pengurus1_id', Auth::id())
                   ->where('status', 'menunggu')
                   ->with('detail_penjemputan')
                   ->get();
        
        try {
            return $this->sendResponse('succes', 'Request data has been succesfully get', $data, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'Request data failed to get', null, 500);
        }
    }
    
    public function acceptNasabahRequest($pj_id , Penyetoran $pt, Penjemputan $pj, DetailPenjemputan $d_pj) 
    {
        $pj = $pj->where('id', $pj_id)
                 ->where('pengurus1_id', Auth::id())
                 ->where('status', 'menunggu')
                 ->first();

        if(!empty($pj)) {
            $pj->update(['status' => 'diterima']);
        }

        try {
            return $this->sendResponse('succes', 'Request data has been succesfully get', $pj, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'Request data failed to get', null, 500);
        }
    }

    public function penyetoranNasabah(Request $request, Penyetoran $pt, DetailPenyetoran $d_pt, Carbon $carbon) 
    {
        $tanggal = $carbon->now()->toDateString();

        $data = DB::transaction(function() use($request, $pt, $d_pt, $tanggal){
            $pt = $pt->firstOrCreate([
                'tanggal'               => $tanggal,
                'nasabah_id'            => $request->nasabah_id,
                'pengurus1_id'          => $request->pengurus1_id,
                'keterangan_penyetoran' => $request->keterangan_penyetoran,
                'lokasi'                => $request->lokasi,
            ]);
            
            $sampahs = $request->sampah;
            foreach($sampahs as $sampah) {
                $harga_perkilogram = Sampah::firstWhere('id', $sampah['sampah_id'])->harga_perkilogram;
                $harga_jemput = $harga_perkilogram + ($harga_perkilogram * 0.2);
                $pt->detail_penyetoran()->createOrUpdate([
                    'sampah_id'     => $sampah['sampah_id'],
                    'berat'         => $sampah['berat'],
                    'harga'         => $harga_perkilogram,
                    'debit_nasabah' => $request->keterangan_penyetoran == 'dijemput' 
                                            ? $harga_jemput * $sampah['berat']
                                            : $harga_perkilogram * $sampah['berat'],
                ]);
            }

            $pt->update([
                'total_berat' => $d_pt->where('penyetoran_id', $pt->id)->sum('berat'),
                'total_debit' => $d_pt->where('penyetoran_id', $pt->id)->sum('debit_nasabah'),
            ]);

            return $pt->load('detail_penyetoran');
        });


    }
}
