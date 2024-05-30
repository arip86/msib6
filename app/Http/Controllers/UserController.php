<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Auth;

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
}
