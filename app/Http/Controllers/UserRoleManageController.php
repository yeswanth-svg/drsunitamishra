<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Donor;
use App\User;
use App\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRoleManageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin','capability']);

    }
    public function new_user(){
        return view('backend.user-role-manage.add-new-user');
    }
    public function new_user_add(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:admins',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'required|string',
            'password' => 'required|min:8|confirmed'
        ]);
       Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $request->image,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with(['msg' => __('New User Added Success'),'type' =>'success' ]);
    }

    public function all_user(){
        $all_user = Admin::all()->except(Auth::id());
        return view('backend.user-role-manage.all-user')->with(['all_user' => $all_user]);
    }
    public function user_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'required|string'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $request->image
        ];
        
        if (!empty($request->password) && !empty($request->password_confirmation)){
            $data['password'] = Hash::make($request->password);
        }
        Admin::find($request->user_id)->update($data);
        return redirect()->back()->with(['msg' => __('User Details Updated'),'type' =>'success' ]);
    }
    public function new_user_delete(Request $request,$id){
        Admin::find($id)->delete();
        return redirect()->back()->with(['msg' => __('User Deleted'),'type' =>'danger' ]);
    }
    public function user_password_change(Request $request){
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = Admin::findOrFail($request->ch_user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['msg'=> __('Password Change Success..'),'type'=> 'success']);

    }
}
