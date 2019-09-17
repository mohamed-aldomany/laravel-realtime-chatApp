<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            .list-group{
                overflow-y: scroll;
                height: 400px;
                border:5px solid blue;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')

        <div id="app" class="container mt-5 mb-5">
            <li class="list-group-item active">Chat App<small class="float-right">@{{numberOfUsers}}</small></li>
            <h4><span class="badge badge-success">@{{chat.typing}}</span></h4>
            <ul class="list-group mt-2 mb-2" v-chat-scroll>
                <message v-for="message,index in chat.message"
                :key="message.index"
                :color=chat.color[index]
                :user=chat.user[index]
                :time=chat.time[index]
                >
                @{{message}}
                </message>
            </ul>
            <input placeholder="enter your message here" type="text" class="form-control" v-model="message" @keyup.enter="send">
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @endsection
    </body>
    </html>
