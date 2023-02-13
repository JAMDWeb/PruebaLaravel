<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //Crear un constructor para aplicar ->middleware('auth')
    // podemos decir a 'auth' que aplique a ['only'=>['create','edit']]
    // o  tambien indicarle que haga lo opuestp, no aplique a:
    // ['except'=>['index','show']] //
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    public function index() // (de 1 solo metodo o accion ) Mostrar el listado de Post
    {
        // Peticion:

        $posts = Post::get();

        //Respuesta:
        return view('posts/index' , ['posts' => $posts] );
    }

    // Si definimos la variable tipo POST eloquen se encarga de gestionar todo
    public function show(Post $post) //Mostrar el detalle de un Post
    {
       //Si no existe muestra 404 not fund
       //return Post::findOrFail($post);
       //return $post;
       //Vamos a retornar una vista
       // por convencion para organizar mejor las vistas es crear una carpeta
       // en este caso posts(en plural) y dentro creamos la vista show
       return view('posts.show',['post' => $post]);

    }

    public function create() // debolver el formulario para crear un Post
    {

       return view('posts.create',['post' => new Post]); // le pasamos una instancia vacia para normalizar

    }

    // En esta caso usamos el form_request generado: php artisan make:request SavePostRequest
    // para encapsular las validaciones
    public function store(SavePostRequest $request) // Para almacenar el Post en la db
    {

    // Validar datos del formulario
    // traducir los mensajes de validacion, por defecto se utiliza el idioma ingles
    // Estos texto estan almacenados en la carpeta lang , en ella se encuentra las carpetas con cada idioma
    // y los archivos php de los mensajes segun el tipo: auth(autenticacion), pagination(paginacion),
    // passwords(contraseña), validation(validacion), como basicos.
    // en la carpeta config, archivo app.php se encuentra definido en 'lacale' la configuracion reginal utilizada
    // para la traducciones segun la region, este valor se puede modificar e indica en que carpeta va a buscar
    // los archivos que se utilizaran.
    // en caso den no existir el archivo de puede utilizar el valor por defecto 'fallback_locale'.
    // pero la comunidad de Laravel a creado los archivos para varios idiomas, esto lo encontramos en:
    // github.com/laravel-Lang/lang , ir a la carpeta locales y buscar el idioma he ir copiando el contenido
    // de cada archivo
    // la version 9 laravel y Laravel-Lang/lang V12 es: composer require laravel-lang/lang --dev y despues
    // php artisan lang:add es : Si quieres otro idiomas solo cambia el (es)

    // Podemos hacer uso de metodo validate(), que va a retornar un array de los valores
    // que realmente se han validados
    // Como la validacion es la misma para el update() y el store(), Se puede crear un form_request
    // para encapsular esta logica. En laravel tenemos un comando,
    // llamado php artisan make:request SavePostRequest (nombre_del_archivo), se crea una peticion para crear un post
    // esto crea una carpeta en caso de que no este: Http/Request/ y el archivo
        // $validated = $request->validate([
        //     // para ver las reglas de validacion disponibles en laravel ver: laravel.com/docs/valitation
        //     'title' => ['required', 'min:4'],
        //     'body' => ['required']

        // ] );
        //dd($validated);

    /*//Otra forma de trabajar con los mensaje segun idioma regional es pasando un segundo parametro a validate()
    ], [
            // . para indicar cual es la regla cullo mensaje queremos sobre escribir
        'title.required' => "Error diferente :attribute al de la carpeta lang/es"
        ] */


    //*****************************************************
    //Acceder a los datos del formulario con la funcion: request()
    // si se retorna directamente larvel convierte el resulta en Json
        // return request();

    // hay otra forma de acceder al request o a la peticion
    // es inyectado la calse request como parametro de la funcion
        // return $request;

    // para acceder idividualmente a los valores de los campos
        // return $request->input('title');

    // Para almacenarlos en DB utilizaremos eloquent

    // Reutilizacion de codigo x D.R.Y.
        // $post = new Post;// nueva instancia del modelo Post
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');
        // $post->save();

    // Con Eloquent tenemos el metodo, qu epodemos llamar de forma estatica
    // y recibir un array como parametro con los campos que se van a ingresar en la DB
    // Pero esta mejora no evita que tengamos que definir los campos manualmente 1x1
    // Podemos hacer uso de metodo validate(), que va a retornar un array de los valores
    // que realmente se han validados
        // Post::create([
        //     'title' => $request->input('title'),
        //     'body'  => $request->input('body'),
        // ]);
        Post::create($request->validated());// con el form_request hay que llamar a la funcion de validadte del $request

    // crear un mensaje de sesion despues de crerar el post
    // podemos elimiar session()->flash() , utilizando el metodo with() en to_route()
    // para definir mensajes de session flash()
        //session()->flash('status','Se creo con exito el post' ); //Este mensaje dura una solo peticion x eso flash

    // para que la pantalla no quede en blanco,
    // una ves creado el post en la db, retornar una re direccion
    // en este caso utilizamos los nombre de la ruta:route('posts.index')
        // return redirect()->route('posts.index');
    // en larevel exite un helper
        return to_route('posts.index')->with('status','Se creo con exito el post');
    }

    public function edit(Post $post )// Mostrar el formulario para editar un Post
    {

        return view('posts.edit',['post' => $post]);

    }

    public function update(SavePostRequest $request, Post $post)// Para almacenar los cambios de un Post en DB
    {

    // Podemos hacer uso de metodo validate(), que va a retornar un array de los valores
    // que realmente se han validados
    // Como la validacion es la misma para el update() y el store(), Se puede crear un form_request
    // para encapsular esta logica. En laravel tenemos un comando,
    // llamado php artisan make:request SavePostRequest (nombre_del_archivo), se crea una peticion para crear un post
    // esto crea una carpeta en caso de que no este: Http/Request/ y el archivo
        // $validated = $request->validate([
        //     'title' => ['required', 'min:4'],
        //     'body' => ['required']
        // ] );

    // Al definir el tipo del parametro $post como tipo Post, Laravel se encarga de realizar el find($post)
    // no hace falta definirlo
        //$post = Post::find($post);
    // Reutilizacion de codigo x D.R.Y.
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');
        // $post->save();

    // Como ya tenemos una istancia del metodo Post , pasarle un array como parametro
    // Pero esta mejora no evita que tengamos que definir los campos manualmente 1x1
    // Podemos hacer uso de metodo validate(), que va a retornar un array de los valores
    // que realmente se han validados
        // $post->update([
        //     'title'=> $request->input('title'),
        //     'body' => $request->input('body'),
        // ]);
        $post->update($request->validated());
    // crear un mensaje de sesion despues de crerar el post
    // podemos elimiar session()->flash() , utilizando el metodo with() en to_route()
    // para definir mensajes de session flash()
        // session()->flash('status','Se actualizo con exito el post' ); //Este mensaje dura una solo peticion x eso flash

        return to_route('posts.show',$post)->with('status','Se actualizo con exito el post');

    }

    public function destroy(POST $post)// Eliminar el Post completo
    {
       $post->delete();

       return to_route('posts.index')->with('status','Post deleted');
    }

}
