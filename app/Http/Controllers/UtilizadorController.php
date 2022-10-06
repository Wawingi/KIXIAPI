<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Utilizador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UtilizadorController extends Controller
{
    public function registarUtilizador(){
        $user = new User;
        $user->username = 'Admin';
        $user->name = 'Admin KixiAPI';
        $user->password = Hash::make('Kc_u-s_i-1520');

        if($user->save()){
            dd('OK');
        }
    }

    public function logar(Request $request){
        //if (Auth::attempt(['username' => $request->username, 'password' => $request->password],true)) {
        if(strtolower($request->username)==strtolower("Administrador") && $request->password=="Kc_u-s_i-1520"){
            return redirect()->intended('dashboard');
        } else {
            return back()->with('error','Erro ao efectuar login. Verifique as credenciais');  
        }
    }

    public function logout(){
        if(Auth::logout()==null)
           return redirect()->intended('/');
        
    }

    //Função logar API para todos local
    public function loginAPI(Request $request){
        $user = Utilizador::select('Nombre01','Nombre03','UtCodigo','departamento','Imagen')
                    ->where('UtCodigo', $request->username)               
                    ->where('UtSenha',sha1($request->password))
                    ->where('Activo',1)
                    ->first();

        if (is_object($user)){         
            return response()->json($user,200);
        } else
            return response()->json(0);
    }
}
