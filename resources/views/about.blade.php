<!-- Plantillas por herencia  -->
{{-- @section('title')
    Abaut
@endsection

@section('meta-description','Abaut meta description') <!-- Se puede pasar como parametro si solo va a ser texto -->

@extends('layouts.app')

@section('content')
    <h1>Acerca de mi en Laravel 9</h1>
@endsection --}}
<x-layouts.app
    title="Home"
    meta-description="Home meta description"
>
    <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Abaut</h1>

</x-layouts.app>
