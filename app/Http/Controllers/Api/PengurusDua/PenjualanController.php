<?php

namespace App\Http\Controllers\Api\PengurusDua;

use App\Gudang;
use App\Sampah;
use App\Pengepul;
use App\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function showPengepul()
    {
        $data = Pengepul::all();

        try {
            return $this->sendResponse('succes', 'Request data has been succesfully get', $data, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'Request data failed to get', null, 500);
        }
    }

    public function sellToPengepul(Request $request) 
    {
        $sampahs = $request->sampah;
            
        foreach($sampahs as $sampah) {
            $stock = Gudang::firstWhere('sampah_id', $sampah['sampah_id'])->total_berat;
            if($stock < $sampah['berat']) {
                $err[] = [ 
                            'sampah_id'         => $sampah['sampah_id'], 
                            'jenis_sampah'      => Sampah::firstWhere('id', $sampah['sampah_id'])->jenis_sampah, 
                            'jumlah_kekurangan' => $stock - $sampah['berat'] 
                         ];
            }            
        }

        if(!empty($err)) {
            return $this->sendResponse('failed', 'The stock quantity of the following items is not sufficient for the demand', collect($err), 400);
        }

        $data = DB::transaction(function() use($request, $sampahs) {   
            $pjl = Penjualan::firstOrCreate([
                'tanggal' => Carbon::now()->toDateString(),
                'pengurus2_id' => Auth::id(),
                'pengepul_id' => $request->pengepul_id,
                'lokasi' => $request->lokasi,
                'status' => 'dalam proses',
            ]);

            foreach($sampahs as $sampah) {
                $harga_j_p = Sampah::firstWhere('id', $sampah['sampah_id'])->harga_jual_perkilogram;
                
                $d_pjl = $pjl->detail_penjualan()->updateOrCreate([
                                                                   'sampah_id' => $sampah['sampah_id'],
                                                                  ],
                                                                  [
                                                                   'berat' => $sampah['berat'],
                                                                   'harga_jual_pengepul' => $harga_j_p,
                                                                   'debit_bank' => $sampah['berat'] * $harga_j_p,
                                                                  ]);
                
            }

            $pjl->update([ 
                          'total_berat_penjualan' => $d_pjl->sum('berat'),
                          'total_debit_bank'      => $d_pjl->sum('debit_bank'),
                         ]);
            
            return Penjualan::firstWhere('id', $d_pjl->penjualan_id)->load('detail_penjualan');
        });

        try {
            return $this->sendResponse('succes', 'Sales data has been succesfully created', $data, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'Sales data failed to create', null, 500);
        }
    }

    public function confirmSaleAsBankTransaction($pjl_id, $auto_confirm = false) 
    {
        $pjl = Penjualan::firstWher('id', $pjl_id);
        
    }

}
