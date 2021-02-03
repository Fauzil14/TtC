<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Gudang;
use App\Sampah;
use App\GolonganSampah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SampahResource;
use RealRashid\SweetAlert\Facades\Alert;

class SampahController extends Controller
{
    public function indexSampah()
    {
        $sampahs   = Sampah::with(['gudang', 'golonganSampah'])->get();
        $golongans = GolonganSampah::get();
        $bank = Bank::first();

        return view('sampah.index')->with(compact('sampahs', 'golongans', 'bank'));
    }

    public function delete($sampah_id)
    {

        $sampah = Sampah::findOrFail($sampah_id);
        
        try {
            $sampah->delete();
    
            Alert::success('Berhasil', 'Data sampah berhasil di hapus');
            return back();
        } catch(\Throwable $e) {
            Alert::error('Gagal', 'Data sampah gagal di hapus');
        }
    }

    public function show($sampah_id)
    {
        Sampah::findOrFail($sampah_id);
    }

    public function tambahSampah(Request $request) 
    {

        $validatedData = $request->validateWithBag('tambah', [
            'golongan_id'     => [ 'required', 'exists:golongan_sampahs,id' ],
            'jenis_sampah'    => [ 'required' ],
            'stok'            => [ 'required', 'numeric', 'gte:5' ],
            'harga'           => [ 'required', 'numeric', 'gte:300' ],
        ]);
        
        try {
            DB::beginTransaction();
            $sampah = Sampah::create([
                'golongan_sampah_id' => $validatedData['golongan_id'],
                'jenis_sampah' => $validatedData['jenis_sampah'],
                'harga_perkilogram' => $validatedData['harga'],
            ]);
            
            $sampah->gudang()->create([ 'total_berat' => $validatedData['stok'] ]);
            
            DB::commit();

            Alert::success('Berhasil', 'Sampah baru berhasil ditambahkan');
            return back();
        } catch(\Throwable $e) {
            report($e);
            DB::rollback();

            Alert::error('Gagal', 'Gagal input data ke database');
            return back();
        }
    }

    public function updateSampah(Request $request)
    {

        $sampah = Sampah::findOrFail($request->sampah_id);

        $validatedData = $request->validateWithBag('edit', [
            'golongan_id'     => [ 'required', 'exists:golongan_sampahs,id' ],
            'jenis_sampah'    => [ 'required' ],
            'stok'            => [ 'required', 'numeric', 'gte:5' ],
            'harga'           => [ 'required', 'numeric', 'gte:300' ],
        ]);
      
        try {
            
            DB::beginTransaction();
            
            $sampah->gudang()->update(['total_berat' => $validatedData['stok']]);
            
            $sampah->update([
                'golongan_sampah_id' => $validatedData['golongan_id'],
                'jenis_sampah' => $validatedData['jenis_sampah'],
                'harga_perkilogram' => $validatedData['harga'],
            ]);

            DB::commit();    

            Alert::success('Berhasil', 'Data sampah berhasil di update');
            return back();

        } catch(\Throwable $e) {
            report($e);
            DB::rollback();

            Alert::error('Gagal', 'Gagal update data sampah');
            return back();
        }
    }
}
