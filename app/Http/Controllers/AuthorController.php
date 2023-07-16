<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Setting;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        return view('back.pages.home');
    }

    public function logout()
    {

        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function RessetForm(Request $request, $token = null)
    {
        $data = [
            'pageTitle' => 'Reset Password'
        ];

        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    public function changeProfilePicture(Request $request){

        dd('heer');

        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $new_picture_name = 'AIMG'.$user->id.time().rand(1,100000).'.jpg';

        if($old_picture != null && File::exists(public_path($file_path))){
            File::delete(public_path($path), $new_picture_name);
            
        }
        $upload = $file->move(public_path($path),$new_picture_name);

        if($upload){
            $user->update([
                'picture'=>$new_picture_name
            ]);
            return response()->json(['status'=>1, 'msg'=>'Your profile picture has been successfuly updated']);
        }else{
            return response()->json(['status'=>0,'Somthing went wrong']);
        }

    }
    
    public function changeBlogLogo(Request $request){
      
        $settings = Setting::find(1);
        $logo_path = './back/dist/img/logo_favicon';
        $old_logo = $settings->getAttributes()['blog_logo'];
        $file = $request->file('blog_logo');
        $filename = time().'_'.rand(1,100000).'_MBlog_logo.png';
        
        if($request->hasFile('blog_logo')){
            dd($request);
            if($old_logo != null && File::exists(public_path($logo_path.$old_logo))){
                File::delete(public_path($logo_path.$old_logo));
            }
            $upload = $file->move(public_path($logo_path),$filename);

            if($upload){
                $settings->update([
                    'blog_logo'=>$filename
                ]);
                return response()->json(['status'=>1, 'msg'=>'MBlog logo successfully updated']);
            }else{
                return response()->json(['status'=>0,'msg'=>'Somthing went wrong']);
                 //something went wrong while uploading the file to server
            }
        }else{ // dd($request);hhhhhhhhhhhhhhhhhhh
        }
    }
}
