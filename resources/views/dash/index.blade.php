@extends('adminlte::page')

@section('title', 'Home')

@section('css')
    
@stop

@section('content_header')
@stop

@section('content')

<div class="rounded py-3 bg-image-full" style="background-image: url(../img/banner3.jpg);">
    <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
    <div style="height: 200px;"></div>  
  </div>
  <!-- Content section -->
  <section class="py-5">
    <div class="container">
      <h1>Antes de Comenzar</h1>
      <p class="lead">Una gran bienvenida a Tarqui Store, nos encanta tenerte en nuestro equipo de trabajo.</p>
      <p>Viviremos grandes momentos y juntos lograremos mucho éxito, Tus cualidades y habilidades agregarán muchos puntos positivos a nuestra empresa y juntos aprenderemos mucho.</p>
    </div>
  </section>

  {{-- <!-- Image element - set the background image for the header in the line below -->
  <div class="py-5 bg-image-full" style="background-image: url(../img/banner2.jpg);">
    <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
    <div style="height: 200px;"></div>
  </div>

  <!-- Content section -->
  <section class="py-5">
    <div class="container">
      <h1>Un paso a la vez</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      <p>Pon en practica.</p>
    </div>
  </section> --}}

  <!-- Footer -->
  <footer class="rounded py-4" style="background-image: url(../img/banner4.jpg);">
    <div class="container">
        <p class="m-0 text-center text-white">“Lo que separa a los emprendedores exitosos de los no exitosos 
            es la perseverancia.” - Steve Jobs</p>
      </div>
  </footer>
  {{-- <section>
    <blockquote class="blockquote text-right" style="background-image: url('https://images7.alphacoders.com/805/805197.jpg');">
        <p  >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
        <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
      </blockquote>
  </section> --}}
@stop



@section('js')

@stop