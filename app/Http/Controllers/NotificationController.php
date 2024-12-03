<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index() {
        $notificationss = Notification::orderBy('created_at', 'desc')->paginate(5);;

        $notification = Auth::user()->notificationss;

        return view('member.notification', compact('notificationss'));
    }
}
