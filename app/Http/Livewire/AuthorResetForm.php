<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthorResetForm extends Component
{

    public $email, $token, $new_password, $confirm_new_password;

    public function mount()
    {
        $this->email = request()->email;
        $this->token = request()->token;
    }
    public function ResetHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:5',
            'confirm_new_password' => 'same:new_password',
        ], [
            'email.required' => 'The Email Field Is Required',
            'email.email' => 'Invalid Email Address',
            'email.exsits' => 'The Email Is Not Registered',
            'new_password.required' => 'Enter New Password',
            'new_password.min' => 'Minimum Characters Must Be 5',
            'confirm_new_password' => 'The Passwords Must Match'
        ]);

        $check_token = DB::table('password_reset_tokens')->where([
            'email' => $this->email,
            'token' => $this->token,
        ])->first();

        if (!$check_token) {
            Session()->flash('fail', 'Invalid Token.');
        } else {
            User::where('email', $this->email)->update([
                'password' => Hash::make($this->new_password)
            ]);
            DB::table('password_reset_tokens')->where([
                'email' => $this->email
            ])->delete();

            $success_token = Str::random(64);
            session()->flash('success', 'Your password has been updated successsfully. 
            Login with your email and your new password');

            $this->redirectRoute('author.login', ['tnk' => $success_token, 'UEmail' => $this->email]);
        }
    }

    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
