<?php
//jenis produk dan produk akan dibuat menggunakan 
//type penulisan Query Builder 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisProduk;
// use DB;
// library DB ini digunakan ketika menggunakan penulisan Query Builder
use Illuminate\Support\Facades\DB;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // fungsi ini biasanya digunakan untuk mengarahkan ke file index
        //variable jenis ini mendeklarasikan table yang diambil dari model
        //untuk kemudian variable tersebut dikirimkan ke view
        $jenis = DB::table('jenis_produk')->get();
        //return view mengarahkan ke view dan compact mengirim variable ke view
        return view ('admin.jenis.index', compact('jenis'));
        // return view ('admin.jenis.index', ['jenis' => $jenis]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menambahkan data menggunakan query builder
        DB::table('jenis_produk')->insert([
            'nama'=> $request->nama,
        ]);
        //return view mengarahkan ke file sebelum proses atau akan diproses 
        //return redirect mengarahkan ke file setelah proses 
        return redirect('admin/jenis_produk');
        // redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
