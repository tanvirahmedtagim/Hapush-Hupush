<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use Image;
use Session;
use App\Models\Admin;


class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
     return view('admin.dashboard');
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules= [
                'email'=>'required|email|max:255',
                'password'=>'required|max:30'
            ];


            $customMassages = [
                'email.required'=>'Email is required',
                'email.email'=>'Valid Email is Required',
                'password.required'=>'password is required',
            ];
            $this->validate($request,$rules,$customMassages);
            // echo "<pre>";print_r($data);die;


            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                //Remember Admin Email & Password With cookies
                if(isset($data['remember'])&&!empty($data['remember'])){
                    setcookie("email",$data['email'],time()+7200);
                    setcookie("password",$data['password'],time()+7200);
                }else{
                    setcookie("email","");
                    setcookie("password","");

                }


                return redirect("admin/dashboard");
              }
            else{
                return redirect()->back()->with('error_massage',"Invalid Email or Password");
            }

        }
        return view('admin.login');
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }


    public function updatePassword(Request $request){
        Session::put('page','update-password');

        if($request->isMethod('post')){
            $data = $request->all();
            //check if current password is currect
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                 //check if new password and confirm password are same
                 if($data['new_pwd']==$data['confirm_pwd']){
                    //Update New Password
                    Admin::where('id',Auth::guard('admin')->user()->id)->update    (['password'=>bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_massage','Password Has Been Updated Successfully!!');

                 }else{
                    return redirect()->back()->with('error_massage','New Password And Retype Password are not Matching !');
                 }
            }else{
                return redirect()->back()->with('error_massage','Your Current Password is Incorrect!');
            }

        }
        return view('admin.update_password');
    }
    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
           }
    }



    public function updateDetails(Request $request){
        Session::put('page','update-details');

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;

            $rules= [
                'admin_name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'admin_mobile'=>'required|numeric|digits:11',
                 'admin_image'=> 'image|required',
            ];


            $customMassages = [
                'admin_name.required'=>'Name is required',
                'admin_name.regex'=>'Valid Name is required',
                'admin_name.max'=>'Valid Name is required',
                'admin_mobile.required'=>'Mobile Number is required',
                'admin_mobile.numeric'=>'Valid Mobile Number is required',
                'admin_mobile.digits'=>'Valid Mobile Number is required',
                'admin_image.image'=>'Valid Image is required',
            ];
            $this->validate($request,$rules,$customMassages);
            //Upload Admin Image
            if($request->hasFile('admin_image')){
                $image_tmp=$request->file('admin_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                  $imageName =rand(111,9999).'.'.$extension;
                  $image_path ='admin/images/photos/'.$imageName;
                  Image::make($image_tmp)->save($image_path);

                }
            }


             //Update Admin Details
            Admin::where('email',Auth::guard('admin')->user()->email)->
                update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
            return redirect()->back()->with('success_massage','Admin Details Has
                Been Updated  Successfully!!');







        }


        return view('admin.update_details');
    }


    public function subadmins(){
        Session::put('page','subadmins');
        $subadmins = Admin::where('type','subadmin')->get();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }
    public function updateSubadminStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo"<pre>";print_r($data); die;
            if($data['status']=="Active"){
                $status =0;
            }else{
                $status=1;
            }
            Admin::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }
    public function deleteSubadmin($id)
    {
        //Delete Subadmin
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('success_massage','Sub Admin deleted Successfully');
    }
}
