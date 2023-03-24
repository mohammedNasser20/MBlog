<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthorChangePasswordForm extends Component
{
    public $current_password, $new_password, $confirm_new_password;
    
    public function changePassword(){
        $this->validate([
            'current_password'=>[
                'required', function($attribute, $value, $fail){
                    if(!Hash::check($value, User::find(auth('web')->id())->password)){
                        return $fail(_('The Current Password Is Incorrect'));
                    }
                },
            ],
                'new_password'=>'required|min:5|max:25',
                'confirm_new_password'=>'same:new_password',
           ],[
                'current_password.required'=>'Enter your current Password',
                'new_password.required'=>'Enter new password',
                'confirm_new_password'=>'The passwords should be the same'   
        ]);

        $query = User::find(auth('web')->id())->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if($query){
            $this->showToastr('Your Password Has Been Successfuly Updared','success.');
            $this->current_password = $this->new_password = $this->confirm_new_password = null;
        }else{
            $this->showToastr('something went wrong.','error');
        }
    }
    public function showToastr($message, $type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }
    public function render()
    {
        return view('livewire.author-change-password-form');
    }
}
