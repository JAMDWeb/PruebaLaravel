<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    //
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required','string'],

        ]);

        // boolean('remember') no sirv pára tomar el valor de los checkbox //
        if(!Auth::attempt($credentials,$request->boolean('remember'))){
            // False: Login Fail
            throw ValidationException ::withMessages([
                // enviar mensajes traducible, para este caso tenemos 'auth.failed'
                // estos estan en desntro de la carpeta las land/es/auth.php
                'email' => __('auth.failed')
            ]);

        };
        // True : Login success
        //el metodo attempt() se encarga de iniciar la secion, pero es muy importante
        //llamar al metodo regenerate() a traves de la sesion d ela peticion
        $request->session()->regenerate();
        //posteriormente redirecionamos a la url prevista
        //supongamoa que queremos acceder a la ruta Dashboard y no estamos autenticados,
        //nos redireciona a la ruta Login, luego de hacer login vamos a ser
        // redireccionado  a laruta Dashboard
        // para eso es el metodo intended(), y recibe un parametro, que es una url por defecto
        // en caso de que hayamos llegado al login directamente, podemos dejarlo en blanco
        // que por defecto nos direcciona a la raiz ('/'),
        return redirect()->intended()
            // podemos pasarle un mensaje de sesion flash, que ya se ha iniciado sesion.
            ->with('status', __('auth.login_ok'));
        ;


    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return to_route('login')->with('status', 'Cerraste session');
        return to_route('login')->with('status', __('auth.login_out'));
    }
}
