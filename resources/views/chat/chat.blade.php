@extends('layouts.app')

@section('content')

    <chat-component :user="{{$user}}"></chat-component>

@endsection
