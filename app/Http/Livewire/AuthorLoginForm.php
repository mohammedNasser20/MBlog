<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

//use Illuminate\Auth\Events\Logout;


class AuthorLoginForm extends Component
{
    public $login_id, $password;

    public function LoginHandler()
    {

        $fieldtype = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldtype == 'email') {
               //// validate when it is email
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Email Or Username is Required',
                'login_id.email' => 'Invalid email addres',
                'login_id.exists' => 'This email is not registered in database',
                'password.required' => 'Password is required',
            ]);
        } else {

            //////// validate when username
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5',
            ],[
                'login_id.required' => 'Email Or Username is Required',
                'login_id.exists' => ' Username is not registered',
                'password.required' => 'Password is required',
            ]);
        }

        $creds = array($fieldtype=>$this->login_id, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {

            $checkUser = User::where($fieldtype, $this->login_id)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account had been blocked');
            } else {
                return redirect()->route('author.home');
            }

        }else{

            session()->flash('fail', 'Incorrect Email/Username Or Password');
        }


        /* $this->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5'
        ],[
            'email.required' => 'Enter your email address',
            'email.email' => 'Invalid email addres',
            'email.exists' => 'This email is not registered in database',
            'password.required' => 'Password is required',
        ]);

        $creds = array('email'=> $this->email, 'password' => $this->password);
        

        if (Auth::guard('web')->attempt($creds)) {

            $checkUser = User::where('email', $this->email)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account had been blocked');
            } else {
                return redirect()->route('author.home');
            }
        } else {

            session()->flash('fail', 'Incorrect email or password');
        }*/
    }
    public function render()
    {
        return view('livewire.author-login-form');
    }
}
