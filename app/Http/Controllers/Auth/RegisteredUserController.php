<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;

class RegisteredUserController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name'  =>['required','string','max:255'],
            'email' =>['required','string','email','max:255','unique:users'],
            'password' =>['required','confirmed',Rules\Password::default(),]


        ]);

        //Auto Login: Autenticarlo automaticamente
        // Cuardar al usuario en una variable
        // $user = User::create([
        User::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            // es importante encriptar las password antes de guardar en DB
            'password'=> bcrypt($request->input('password')),
            //Otro metodo de encriptacion es:
            //'password'=> Hash::make($request->input('password')),


        ]);
        //Auto Login: Autenticarlo automaticamente
        // Auth::login($user);

        //Manual Login: O redireccionarlo al login
        //Para que inicie session con los datos que acaba de crear
        return to_route('login')->with('status','Account created!');

    }
}
