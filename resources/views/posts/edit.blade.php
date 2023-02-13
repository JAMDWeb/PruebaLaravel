<x-layouts.app
    {{-- con : podemos evaluar php entro de html  --}}
        :title="$post->title"
        :meta-description="$post->body"
>
    <h1 class="my-4 font-serif text-3xl text-center text-sky-600
            dark:text-sky-500">Edit form</h1>
    {{-- @dump($post->toArray()) --}}
    <form class="max-w-xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800"
            action="{{ route('posts.update',$post) }}" method="POST">
        {{-- cuando utilicemos un formulario con el metodo POST
        debemos utilizar la directiva @csrf, Lo que hace la directiva
        es imprimir un token dentro del formulario para verificar el origen.
        La duracion del token es de 2 horas --}}
        @csrf
        {{-- Para editar algun registro debemos tener el method=POST
             y la directiva @method('PATCH') con el nombre del metodo que queremos soportar --}}
        @method('PATCH')

        @include('posts.form-fields')

        <div class="flex items-center justify-between mt-4">
            {{-- <a href="/blog">Regresar</a> --}}
            {{-- es bueno acceder a rutas con nombre en lugar de la url --}}
            <a class="text-sm font-semibold underline border-2 border-transparent
                rounded dark:text-slate-300 text-slate-600 focus:border-slate-500
                focus:outline-none" href="{{ route('posts.index') }}">Regresar</a>
            <button class="inline-flex items-center px-4 py-2 text-xs font-semibold
                tracking-widest text-center text-white uppercase transition duration-150
                ease-in-out border border-2 border-transparent rounded-md dark:text-sky-200
                bg-sky-800 hover:bg-sky-700 active:bg-sky-700 focus:outline-none
                focus:border-sky-500" type="submit">Enviar</button>
        </div>



    </form>



</x-layouts.app>
