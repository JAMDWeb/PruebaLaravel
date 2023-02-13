<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
// Solucion error
// Add [title] to fillable property to allow mass assignment on [App\Models\Post].
    // protected $fillable =  [ // $fillable(llenable o rellenable): Podran se informados en forma masiva
    //     'title',
    //     'body'

    // ];

// $guarded: Los que no se podran informar en forma masiva.
// si le pasamos un array vacio le indicamos que deje pasar todos los campos
// En produccion vamos a deshabilitar $filable y $guarded=[], pero la condicion es que:
// nunca deneremos usar la funcion all() en los metodos create() y update()
// Podemos desavilitar esta proteccion para todos los modelos de Eloquent que creemos a futuro
// sacamos la proteccion $guarded=[] y en el archivo AppServiceProvider que esta /app/Providers/
// en el metodo boot() agregamos Model::unguard();
    //protected $guarded =  [];
}
