<?php

namespace App\Http\Controllers\Api\PengurusSatu;

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
                 
        $d_pj = $d_pj->where('penjemputan_id', $pj_id)->get()->toArray();

        $data = DB::transaction(function() use($pt, $pj, $d_pj){
            $pt = $pt->create([
                'tanggal'               => $pj->tanggal,
                'nasabah_id'            => $pj->nasabah_id,
                'pengurus1_id'          => $pj->pengurus1_id,
                'keterangan_penyetoran' => "dijemput",
                'lokasi'                => $pj->lokasi,
                'total_berat'           => $pj->total_berat,
                'total_debit'           => $pj->total_harga,
                'status'                => "dalam proses",
            ]);

            if(!empty($d_pj)) {
                foreach($d_pj as $key => $value) {
                    $pt->detail_penyetoran()->create([
                        'sampah_id'     => $d_pj[$key]['sampah_id'],
                        'berat'         => $d_pj[$key]['berat'],
                        'harga'         => $d_pj[$key]['harga_perkilogram'],
                        'debit_nasabah' => $d_pj[$key]['harga'],
                        'status' => "menunggu",
                    ]);
                }
            }

            return $pt->load('detail_penyetoran');
        });

        if(!empty($data)) {
            $pj->update(['status' => 'berhasil']);
        }

        try {
            return $this->sendResponse('succes', 'Request data has been succesfully get', $data, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'Request data failed to get', null, 500);
        }
    }

    public function penyetoranNasabah(Penyetoran $pt, DetailPenyetoran $d_pt, Carbon $carbon) 
    {

    }
}
