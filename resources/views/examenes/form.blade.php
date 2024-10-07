@extends('layouts.app')

@section('css')
     @livewireStyles
    <style>
     
 
      body{
        background: #001e4d;
      }
      .app{
        background: #fff ;
        width: 90%;
        max-width: 600px;
        margin: 100px auto 0;
        border-radius: 10px;
        padding: 30px;

      }

      .app h1{
        font-size: 25px;
        color: #001e4d;
        font-weight: 600;
        border-bottom: 1px solid #333;
        padding-bottom: 30px;
      }

      .quiz{
        padding: 20px 0;

      }

      .quiz h2{
        font-size: 18px;
        color: #001e4d;
        font-weight: 600;

      }

      .btn-ans{
        background: #fff;
        color: #222;
        font-weight: 500;
        width: 100%;
        border:  1px solid #222;
        padding: 10px;
        margin: 10px 0;
        text-align: left;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
      }

      .btn-ans:hover{
        background: #222;
        color: #fff;
      }

      #next-btn{
        background: #001e4d;
        color: #fff;
        font-weight: 500;
        width: 150px;
        border: 0;
        padding: 10px;
        margin: 20px auto 0;
        border-radius: 4px;
        cursor: pointer;
        display: none;
      }
    </style>
@endsection

@section('content')


    
@endsection

@section('js')
@livewireScripts

    
@endsection