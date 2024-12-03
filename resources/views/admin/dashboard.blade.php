@extends('layouts.master')

@section('title')
    Dashboard Admin
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
         @if(session('login_message'))
            var message = @json(session('login_message'));
            toastr.success(message, 'Login Successful', {
                timeOut: 5000,
                extendedTimeOut: 15000,
                closeButton: true,
                progressBar: true
            });
        @endif
    </script>    

    <h2>Hi, {{ Auth::user()->name }}</h2>

   <form action="{{ route('logout') }}" method="post">
        @csrf

        <button type="submit" class="btn btn-danger mt-4">Log out</button>
   </form>
@endsection