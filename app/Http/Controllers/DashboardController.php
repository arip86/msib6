<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Kartu;
use App\Models\JenisProduk;
use DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $produk = Produk::count();
        $pelanggan = Pelanggan::count();
        $jenis_produk = JenisProduk::count();
        $kartu = Kartu::count();
        $produkData = Produk::select('kode', 'harga_jual')->get();
        // $produkData=json()['data'];
        //pengubahan data ke json
        $jenis_kelamin = DB::table('pelanggan')
        ->selectRaw('jk, count(jk) as jumlah')
        ->groupBy('jk')
        ->get();
        return view('admin.dashboard', 
        compact('produk', 'pelanggan','kartu', 'jenis_produk', 
        'produkData', 'jenis_kelamin'));
    }
}
