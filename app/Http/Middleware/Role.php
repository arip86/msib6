<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Auth;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if(!Auth::check()){
            // return redirect('login');
            abort(403, 'Belum Mempunyai account');
        }
        $roles = explode('|', $roles);
         //explode mengubah data dari string menjadi array
         //string mana yang diubah ? yaitu admin, manager, staff, pelanggan
         $user = Auth::user();
         //setelah sudah diubah array maka user dicek apakah sudah teregister atau belum
         //jika sudah maka looping data kolom rolenya
         foreach($roles as $role){
            //setelah dilooping, jika rolenya termasuk yang dideklarasikan di route.web
            //maka lanjutkan, jika tidak maka arahkan ke / atau halaman depan
            if ($user->role($role)){
                return $next($request);
            }
         }
         return redirect('/');

    }
}
