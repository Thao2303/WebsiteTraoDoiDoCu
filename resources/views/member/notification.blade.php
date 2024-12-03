@extends('layouts.master')

@section('title')
    Notifications List
@endsection

@section('content')
<div class="container mt-5">
    @foreach($notificationss as $notification)
        <div class="notification-item">
            <div class="alert alert-info d-flex">
                <div class="col-icon">
                    <i class="fas fa-bell"></i>
                </div>

                <div class="col-content">
                    <h4 class="alert-heading">{{ $notification->title }}</h4>
                    <p>{{ $notification->content }}</p>
                </div>

                <div class="col-time">
                    <small>
                        {{ \Carbon\Carbon::parse($notification->sent_at ?? $notification->created_at)->format('d-m-Y H:i:s') }}
                    </small>
                </div>
            </div>
        </div>
    @endforeach

    <div class="text-center mt-4">
        {{ $notificationss->links('pagination::bootstrap-4') }}
    </div>
</div>

<style>
    .notification-item {
        max-width: 900px;
        margin: 0 auto;
        /* padding: 10px 0; */
    }

    .alert {
        display: flex;
        align-items: center;
        padding: 25px;
        border-radius: 0;
        margin-bottom: 0;
        background-color: #e9f7fe;
        border-color: #b3e0ff;
    }

    .col-icon {
        flex: 1;
        text-align: center;
        font-size: 30px;
        color: #007bff;
    }

    .col-content {
        flex: 6;
        padding-left: 15px;
    }

    .col-time {
        flex: 3;
        text-align: right;
        font-size: 0.9em;
        color: gray;
    }

    .alert-heading {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .alert p {
        margin-bottom: 0;
        margin-top:10px;
    }
</style>
@endsection