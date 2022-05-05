 
@extends('layouts.app')
 
 @section('title', 'Adivina la palabra')
  
 @section('content')
     <div class="row">
        <div class="col-12">
            <h1 class="text-center">Adivina la palabra</h1>
        </div>
     </div>
     <div class="row my-3">
         <div class="col-12 text-center">
             <button class="btn btn-primary" id="btn_newGame" name="btn_newGame">¡Nueva Partida!</button>
             <input type="hidden" value="{{route('adivina-la-palabra.newGame')}}" id="newGameRoute">
        </div>
    </div>

 @endsection
 @section('js')

 @endsection