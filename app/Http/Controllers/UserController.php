<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash; //hash adalah library yang membantu kita mengenkripsi password
use Illuminate\Support\Facades\Storage; //menyimpan file selayaknya public dan storage menghubungkan ke public
//jika library ini dipanggil, ketika mengambil dari github, harus melakukan proses pengetikan sebegai berikut
// php artisan storage:link, agar storage terhubung ke public 

class UserController extends Controller
{
    //
    public function index(){
        // $userAll = User::where('is_active', true)->get();
        $userAll = User::all();
        // $users = User::where('is_active', false)->get();
        return view('admin.user.index', compact( 'userAll' ));

    }
    public function activate(User $user){
        $user->is_active = true;
        $user->save();

        return redirect('admin/user')->with('success', 'User Berhasil diaktifkan');
    }
    public function showProfile(){
        $user = User::findOrFail(Auth::id());
        return view('admin.user.profile', compact('user'));
    }
    public function update(Request $request, $id){
     //validate 
     request()->validate([
        'name' => 'required|string|min:2|max:100',
        'email' => 'required|email|unique:users,email, '.$id.',id',
        'old_password' => 'nullable|string',
        'password' => 'nullable|required_with:old_password|string|confirmed|min:6'
     ]);
     $user = User::find($id);
     $user->name = $request->name;
     $user->email = $request->email;
     if($request->filled('old_password')){
        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        } else {
            return back()
            ->withErrors(['old_password' => __('Tolong periksa passwordnya lagi')])
            ->withInput();
        }
     }
     if(request()->hasFile('foto')){
        //kodingan dibawah ini untuk pengecekan apakah foto sudah ada atau belum
        if($user->foto && file_exists(storage_path('app/public/fotos/'.$user->foto))){
            Storage::delete('app/public/fotos'.$user->foto);
        }
        //proses requst foto setelah dicek
        $file = $request->file('foto');
        $fileName = 'foto-'.uniqid().$file->getClientOriginalName();
        //pengecekan ekstension, dia sebagai .png .jpg. jpeg dan seterusnya 
        // $fileName = '.'. $file->getClientOriginalExtension();
        //dimasukan ke file storagenya 
        $request->foto->move(storage_path('app/public/fotos/'), $fileName);
        //request menggunakan eloquent
        $user->foto = $fileName;
     }   
     $user->role = $request->role;
     $user->save();
     return back()->with('success', 'Profile Terupdate');
    }
}
