<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\JenisProduk;
use DB; 
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class BerandaController extends Controller
{
    //
    public function index(){
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();
        return view ('front.home', compact('produk'));
    }
    public function addToCart($id){
    $produk = Produk::findOrFail($id);
    $cart = session()->get('cart', []);
    //session library yang menyimpan sebuah history
    if(isset($cart[$id])){
        $cart[$id]['quantity']++;
        //increment penambahan value secara berkala 
    } else {
        $cart[$id] = [
            "nama" => $produk->nama,
            "quantity" => 1,
            "harga_jual" => $produk->harga_jual,
            "foto" => $produk->foto
        ];
    }
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Produk Berhasil ditambahkan ke Cart');
    }
    public function detail($id){
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->get();

        return view('front.detail', compact('produk'));
    }
    public function cart(){
        //panggil detail produk yang sudah masuk kedalam cart
        $produk = Produk::all();
        $cart = session()->get('cart');
        //hitung total harga 
        $total = 0;
        if($cart){
            foreach($cart as $key => $produk){
                $total += $produk['harga_jual'] * $produk['quantity'];

            }
            return view ('front.shop_cart', compact('produk', 'cart', 'total'));
        }
        return view('front.home', compact('produk'));
    }
}
