
{{-- validacion de datos del formulario Cliente usando required, puede ser modificada
            editando el html, por eso hay que realizarla del lado del Servidor
            En el caso que solo se de el error en un campo y no queres perder los datos
            cargado correctamente , en el campo de entrada debemos darle un valor por defecto
            con la funcion old() de laravel y pasarle el  nombre del campo
            value="{{ old('title') }}
        --}}
{{-- reestructuracion por R.R.Y (Don't repeat yourself): No te repitas
        vamos a aplicarlo en los campos title y body, que lo usamos tambienen edit.balde.php,
        para ello devemos normalizarlos, y le agregamos en value, el parametro $post->title
        pero en e form de create, no temos la variable $post, debemos agregarlo en el controlador ,
        pero como estasmo crear y no tenemos un post, debemos pasarle una nueva instancia vacia ['post' => new Post]
        que la estructura html sean iguales en anvos  --}}
        {{-- sacamos los label de lo input title y body  --}}

{{-- De ahora en adelane cuando queramos agregar un campo al formulario de post, lo agregaremos aqui
    en el form-fields y agregamos las reglas de validaciones en form_request(SavePostRequest)
    --}}

<div class="space-y-4">
    {{-- Ver de crear un compomente para reutilizar la estructura de codigo
        que se repite , aplicar D.R.Y , como se hizo con form-fields --}}
    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">Title</span>
        <input class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80
            text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300
            dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700
            focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100
            dark:placeholder:text-slate-400" type="text" name="title"
            id="" value="{{old('title',$post->title)}}" >
        @error('title')
            {{-- variable especial $message esta disponible dentro de la directiva @error() --}}
            <small >{{ $message }}</small>
        @enderror
    </label>
    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">Body</span>
        <textarea class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80
            text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800
            focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800
            dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            name="body">{{old('body', $post->body)}}</textarea>
        @error('body')

        {{-- variable especial $message esta disponible dentro de la directiva @error() --}}
        <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror

    </label>
</div>


