<x-layouts.app
    title="Register"
    meta-description="Register meta description"
>
<h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Register</h1>
<form class="max-w-xl px-8 py-4 mx-auto bg-white rounded shadow
        dark:bg-slate-800" action="{{ route('register') }}"
        method="POST">
        {{-- cuando utilicemos un formulario con el metodo POST
        debemos utilizar la directiva @csrf
        Lo que hace la directiva es imprimir un token dentro del formulario
        para verificar el origen.
        La duracion del token es de 2 horas --}}
        @csrf

        {{-- reestructuracion por D.R.Y (Don't repeat yourself): No te repitas
        vamos a aplicarlo en los campos title y body, que lo usamos tambienen edit.balde.php,
        para ello devemos normalizarlos, y le agregamos en value, el parametro $post->title
        pero en e form de create, no temos la variable $post, debemos agregarlo en el controlador ,
        pero como estasmo crear y no tenemos un post, debemos pasarle una nueva instancia vacia ['post' => new Post]
        que la estructura html sean iguales en anvos  --}}
        {{-- sacamos los label de lo input title y body  --}}

        {{-- @include('posts.form-fields') --}}

        <div class="space-y-4">
            {{-- Ver de crear un compomente para reutilizar la estructura de codigo
                que se repite , aplicar D.R.Y , como se hizo con form-fields --}}
            <label class="flex flex-col">
                <span class="font-serif text-slate-600 dark:text-slate-400">
                    Name
                </span>
                <input class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80
                    text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300
                    dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700
                    focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100
                    dark:placeholder:text-slate-400"
                    autofocus="autofocus"
                    type="text"
                    name="name"
                    value="{{old('name')}}" >
                @error('name')
                    {{-- variable especial $message esta disponible dentro de la directiva @error() --}}
                    <small >{{ $message }}</small>
                @enderror
            </label>
            <label class="flex flex-col">
                <span class="font-serif text-slate-600 dark:text-slate-400">
                    Email
                </span>
                <input class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80
                    text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300
                    dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700
                    focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100
                    dark:placeholder:text-slate-400"
                    type="email"
                    name="email"
                    {{-- value="{{old('email')}}" --}}
                     >
                @error('email')
                    {{-- variable especial $message esta disponible dentro de la directiva @error() --}}
                    <small >{{ $message }}</small>
                @enderror
            </label>
            <label class="flex flex-col">
                <span class="font-serif text-slate-600 dark:text-slate-400">
                    Password
                </span>
                <input class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80
                    text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300
                    dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700
                    focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100
                    dark:placeholder:text-slate-400"
                    type="password"
                    name="password"
                    {{-- value="{{old('password')}}"  --}}
                    >
                @error('password')
                    {{-- variable especial $message esta disponible dentro de la directiva @error() --}}
                    <small >{{ $message }}</small>
                @enderror
            </label>
            <label class="flex flex-col">
                <span class="font-serif text-slate-600 dark:text-slate-400">
                    Password Confirmation
                </span>
                <input class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80
                    text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300
                    dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700
                    focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100
                    dark:placeholder:text-slate-400"
                    type="password"
                    name="password_confirmation"
                    value="{{old('password_confirmation')}}" >
                @error('password_confirmation')
                    {{-- variable especial $message esta disponible dentro de la directiva @error() --}}
                    <small >{{ $message }}</small>
                @enderror
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            {{-- es bueno acceder a rutas con nombre en lugar de la url --}}
            <a class="text-sm font-semibold underline border-2 border-transparent
                rounded dark:text-slate-300 text-slate-600 focus:border-slate-500
                focus:outline-none"
                href="{{ route('login') }}">Login</a>
            <button class="inline-flex items-center px-4 py-2 text-xs font-semibold
                tracking-widest text-center text-white uppercase transition duration-150
                ease-in-out border border-2 border-transparent rounded-md dark:text-sky-200
                bg-sky-800 hover:bg-sky-700 active:bg-sky-700 focus:outline-none
                focus:border-sky-500" type="submit">Register</button>
        </div>

    </form>

</x-layouts.app>
