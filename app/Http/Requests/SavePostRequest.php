<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Stmt\If_;

class SavePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    // aca se puede realizar alguna logica para validad permiso o perfile, para cambiar el return
    //En este caso todos los usuario esta autorizados a realizar esta peticion
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
    // Puede darse el caso de que las reglas de validacion varien
    // por dar un ejemplo: cuando estamos actualizado o creando
    // en estos caso podemos realizar una verificacion
    // de esta forma podemos varias las reglas de validacion
        // if($this->isMethod('PATCH')){
        //     return[
        //         'title' => ['min:8']

        //     ];
        // }

        return [// objeto dedicado para validar los post
            //defimos las reglas de validacion
            'title' => ['required', 'min:4'],
            'body' => ['required']
            // En caso de no tener alguana regla de validacion para un campo especifico
            // podemos agragarlo aqui con un array vacio , par que aparesca al llamar al metodo validated()
            //'otherfile'=> []


        ];
    }
}
