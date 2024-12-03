<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\Registed;
use App\Events\LoggedOut;
use App\Events\UserLoggedIn;


class AuthenController extends Controller
{
    public function showFormLogin () {
        return view('auth.login');
    }

    public function handleLogin () {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            
            $user = Auth::user();
            $userName = $user->name;
    
            $title = '';
            $content = '';
            
            if ($user->isAdmin()) {
                $title = "Welcome Admin " . $userName . "!";
                $content = "You have successfully logged in as Admin.";
    
                event(new UserLoggedIn($user));
    
                session()->flash('login_message', $title . ' ' . $content);
            } else {

                $title = "Welcome Member " . $userName . "!";
                $content = "You have successfully logged in as a Member.";
    
                Notification::create([
                    'title' => $title,
                    'content' => $content,
                    'sent_at' => now()
                ]);
    
                event(new UserLoggedIn($user));
    
                session()->flash('login_message', $title . ' ' . $content);
            }


            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('member.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function showFormRegister () {
        return view('auth.register');
    }

    public function handleRegister () {
        $data = request()->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);

        Auth::login($user);

        request()->session()->regenerate();

        //notification
        session()->flash('registration_message', 'Welcome, ' . $data['name'] . '! You have successfully registered.');

        $title = "Welcome " . $data['name'] . "!";
        $content = "You have successfully registered and logged in.";

        Notification::create([
            'title' => $title,
            'content' => $content,
            'sent_at' => now(),
        ]);

        event(new Registed($user));

        return redirect()->route('member.dashboard');
    }

    public function logout () {

        $user = Auth::user();

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

    //notification
    if ($user->isAdmin()) {

        session()->flash('logout_message', 'Goodbye Admin ' . $user->name . '! You have successfully logged out.');

        event(new LoggedOut($user));

    } else {
        $title = "Goodbye " . $user->name . "!";
        $content = "You have successfully logged out.";

        Notification::create([
            'title' => $title,
            'content' => $content,
            'sent_at' => now()
        ]);

        event(new LoggedOut($user));

        session()->flash('logout_message', $title . ' ' . $content);
    }

        return redirect('/');
    }

}
