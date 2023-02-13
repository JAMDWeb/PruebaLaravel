<!-- Plantillas por herencia  -->
{{-- @section('title','Contact')  <!-- En el caso que sea solo tecto se puede pasar como parametro -->

@section('meta-description','Contact meta description') <!-- Se puede pasar como parametro si solo va a ser texto -->

@extends('layouts.app')

@section('content')
    <h1>Contacto en Laravel 9</h1>
@endsection --}}

<x-layouts.app
    title="Contact"
    meta-description="Contact meta description"
>
<h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Contac</h1>


</x-layouts.app>
