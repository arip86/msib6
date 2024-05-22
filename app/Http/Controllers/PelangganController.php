<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kartu;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pelanggan = Pelanggan::all();
        return view ('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kartu = Kartu::all();
        $gender = ['L', 'P'];
        return view ('admin.pelanggan.create', compact('kartu', 'gender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //proses upload foto
        //jika file foto ada yang terupload
        if(!empty($request->foto)){
            //maka proses berikut yang dijalankan
            $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/image'), $fileName);
        } else {
            $fileName = '';
        }
        //tambah data menggunakan eloquent
        $pelanggan = new Pelanggan;
        $pelanggan->kode = $request->kode;
        $pelanggan->nama = $request->nama;
        $pelanggan->jk = $request->jk;
        $pelanggan->tmp_lahir = $request->tmp_lahir;
        $pelanggan->tgl_lahir = $request->tgl_lahir;
        $pelanggan->email =$request->email;
        $pelanggan->foto = $fileName;
        $pelanggan->kartu_id = $request->kartu_id;
        $pelanggan->save();
        return redirect('admin/pelanggan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show eloquent
        $pelanggan = Pelanggan::find($id);
        // dd($pelanggan);
        return view('admin.pelanggan.detail', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pl = Pelanggan::find($id);
        $kartu = Kartu::all();
        $gender = ['L', 'P'];
        return view ('admin.pelanggan.edit', compact('pl','kartu', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
       //foto lama 
       $fotoLama = Pelanggan::select('foto')->where('id', $id)->get();
       foreach($fotoLama as $f1){
           $fotoLama = $f1->foto;
       }
       //jika foto sudah ada yang terupload 
       if(!empty($request->foto)){
           //maka proses selanjutnya 
       if(!empty($fotoLama->foto)) unlink(public_path('admin/image'.$fotoLama->foto));
       //proses ganti foto
           $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
           //setelah tau fotonya sudah masuk maka tempatkan ke public
           $request->foto->move(public_path('admin/image'), $fileName);
       } else{
           $fileName = $fotoLama;
       }
        //tambah data menggunakan eloquent
        $pelanggan = Pelanggan::find($id);
        $pelanggan->kode = $request->kode;
        $pelanggan->nama = $request->nama;
        $pelanggan->jk = $request->jk;
        $pelanggan->tmp_lahir = $request->tmp_lahir;
        $pelanggan->tgl_lahir = $request->tgl_lahir;
        $pelanggan->email =$request->email;
        $pelanggan->foto = $fileName;
        $pelanggan->kartu_id = $request->kartu_id;
        $pelanggan->save();
        return redirect('admin/pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return redirect('admin/pelanggan');
    }
}
