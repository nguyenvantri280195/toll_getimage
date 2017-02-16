<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
class UserController extends Controller
{
    public function getList(){
        $user = User::select('name','email','level','id')->orderBy('id','DESC')->get()->toArray();
        return view('/user/list',compact('user'));
    }
    public function getAdd(){
        return view('/user/add');
    }
    public function postAdd(UserRequest $userrequest){
        $userId  = Auth::user()->id; 
        if($userId !=1){
            return redirect('/admin/user/list')->with(['flash_level'=>'danger','flash_message'=>'Bạn không phải admin']);
        }
        $User = new User();
        $User->name= $userrequest->username;
        $User->password = Hash::make($userrequest->password);
        $User->email = $userrequest->email;
        $User->level = $userrequest->rdoLevel;
        $User->remember_token = $userrequest->_token;
        $User->save();
        return redirect('/admin/user/list')->with(['flash_level'=>'success','flash_messages'=>'add success']);
    }
    public function getEdit($id){
        $user = User::find($id);
        
        return view('/user/edit',compact('user'));
    }
    public function postEdit($id, Request $request){
        $userId = Auth::user()->id;
        if($userId == 1){
            $user =  User::find($id);
            if($request->password){
                $this->validate( $request,
                [
                    'password'      =>  'required',
                    'rePassword'    =>  'required|same:password',
                ],
                [
                    'password.required'     =>  'Vui long nhập password',
                    'rePassword.required'   =>  'Vui lòng nhập lại password',
                    'rePassword.same'       =>  'Sai password vui lòng nhập lại',
                ]);
                $pass = Hash::make($request->password);
                $user->password = $pass;
              }
              $this->validate($request,
                [
                    'email'             =>  'required',
                ],
                [
                    'email.required'    =>  'Vui lòng nhập email',
                ]);
              $user->email = $request->email;
              $user->level = $request->rdoLevel;
              $user->save();
              return redirect('/admin/user/list')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công']);
        }else if($userId == $id){
            $user =  User::find($id);
            if($request->password){
                $this->validate( $request,
                [
                    'password'      =>  'required',
                    'rePassword'    =>  'required|same:password',
                ],
                [
                    'password.required'     =>  'Vui long nhập password',
                    'rePassword.required'   =>  'Vui lòng nhập lại password',
                    'rePassword.same'       =>  'Sai password vui lòng nhập lại',
                ]);
                $pass = Hash::make($request->password);
                $user->password = $pass;
              }
              $this->validate($request,
                [
                    'email'             =>  'required',
                ],
                [
                    'email.required'    =>  'Vui lòng nhập email',
                ]);
              $user->email = $request->email;
              $user->level = $request->rdoLevel;
              $user->save();
              return redirect('/admin/user/list')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công']);
        }else{
            return redirect('/admin/user/list')->with(['flash_level'=>'danger','flash_message'=>'Bạn không phải admin']);
        }
    }
    public function getDelete($id){
        $userId  = Auth::user()->id; 
        $user = User::find($id);
        if($userId ==1 && $id!=1 ){
            $user->delete();
            return redirect('/admin/user/list')->with(['flash_level'=>'success','flash_message'=>'Xóa user thành công']);
        }elseif($id == 1){
            return redirect('/admin/user/list')->with(['flash_level'=>'danger','flash_message'=>'Bạn không không thể xóa admin']); 
        }else{
            return redirect('/admin/user/list')->with(['flash_level'=>'danger','flash_message'=>'Bạn không phải admin']); 
        }
    }
    public function getLogin(){
        return view('login');
    }
    public function postLogin(Request $request){
    	$this->validate($request,[
    		'username'=>'required',
    		'password'=>'required'
    		],[
    		'username.required'=>'Bạn chưa nhập username',
    		'password.required'=>'Bạn chưa nhập password'
    	]);
    	if(Auth::attempt(['name'=>$request->username,'password'=>$request->password])){
    		return redirect('/admin/getimage/search');
    	}else{
    		return redirect('/login')->with(['flash_level'=>'danger','flash_message'=>'Sai username hoặc password']);
    	}
    }
    public function Logout(){
        Auth::Logout();
        return redirect('/login');
    }
}
