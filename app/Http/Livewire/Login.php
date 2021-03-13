<?php

namespace App\Http\Livewire;

use session;
use App\User;
use Livewire\Component;
// use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;
// use Illuminate\Contracts\Auth\MustVerifyEmail;


class Login extends Component 
{
    public $login_active = true;
    public $register_active = false;

    public $login_form = [
        'email' => '',
        'password' => ''
    ];

    public $register_form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation'
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ];

    public $invalidEmailError = '';

    public function toggleLogin() 
    {
        $this->login_active = true;
        $this->register_active = false;
    }

    public function toggleRegister() 
    {
        $this->login_active = false;
        $this->register_active = true;
    }

    public function login()
    {
        $this->validate([
            'login_form.email' => 'required|email',
            'login_form.password' => 'required'
        ]);

        
        if (Auth::attempt(['email' => $this->login_form['email'], 'password' => $this->login_form['password']])) {
            //return redirect()->intended('dashboard');

            return redirect()->route('home');
            //@dd('login credentials right');
            //return redirect()->route('dashboard');
        }
        else {
            session()->flash('message', 'Please enter correct credentials');
            session()->flash('alert-class', 'alert-danger');

        }
        
        
    }

    public function register()
    {
        $this->validate([
            'register_form.name' => 'required',
            'register_form.email' => 'required|unique:users,email',
            'register_form.password' => 'required|min:6|confirmed',
            'register_form.password_confirmation' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $this->register_form['name'],
            'email' => $this->register_form['email'],
            'password' => Hash::make($this->register_form['password']),
            'role_id' => 3,
        ]);
        
        try {
            event(new Registered($user));
        } catch (\Exception $e) {
            session()->flash('alert-class', 'alert-danger');
            $this->invalidEmailError = 'This means something is wrong with your email';
            
            //if email is invalid, remove that user
            User::destroy($user->user_id);
            return back()->with('message', $e->getMessage().' !');
        }
        
        
        session()->flash('Successfuly registered');
        session()->flash('alert-class', 'alert-success');
        Auth::attempt(['email' => $this->register_form['email'], 'password' => $this->register_form['password']]);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
