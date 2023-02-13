<!--las plantillas estan en /resourse/view
    y que utilice las archivos app que estan en layouts
-->
<!-- Plantillas por herencia  -->
{{--
Directivas por herencia
    @section('title')
        <!-- En este caso se puede realizar alguna accion  -->
        Home
    @endsection

    @section('meta-description','Home meta description') <!-- Se puede pasar como parametro si solo va a ser texto -->

    @extends('layouts.app')

    @section('content')
        <h1>Inicio en Laravel 9</h1>
    @endsection --}}

<!-- Plantillas por componentes blade  -->

    {{-- ALternativa A
         directiva: @component --}}
    {{-- @component('components.layout')
        <h1>Inicio en Laravel 9</h1>
    @endcomponent --}}

    {{-- ALternativa b --}}
    {{-- Otra alternativa es por atributos
        si queremos que sea opcional utilizamos en el layout title
        el operador el operador de php ?? --}}
    <x-layouts.app
        title="Home"
        meta-description="Home meta description"
        {{-- Si queremos que se evalue php : SUM  --}}
        {{-- :sum="2 + 2" --}}

    >   {{-- para referenciar una propriedad usamos kebab case --}}
        {{-- ALternativa A --}}
        {{-- En el caso de querer imprimir estrucuras html
            podemos usar slot con nombres --}}
        {{-- <x-slot name="title">
            Home Title
        </x-slot> --}}

        <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Home</h1>
        @auth
            <pre class="text-wrtite">
                Authenticated User:{{ Auth::user()->name }}

            </pre>
        @endauth
    </x-layouts.app>

