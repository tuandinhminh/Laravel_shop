<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\NguoiDung;

class NguoiDungLoginController extends Controller
{
    //
	public function __construct(){
		$this->middleware('guest:nguoidung');
	}

	public function showLoginForm(){
		return view('page.dangnhap');
	}

	public function login(Request $req){
		$validate = Validator::make($req->all(),
			[
				'email'=>'required|email',
				'password'=>'required|min:6|max:20'
			],
			[
				'email.required'=>'vui lòng nhập email',
				'email.email'=>'email không đúng dịnh dạng',
				'password.required'=>'vui lòng nhập mật khẩu',
				'password.min'=>'mật khẩu ít nhất 6 kí tự',
				'password.max'=>'mật khẩu nhiều nhất 20 kí tự'
			]);
		if ($validate->fails()) {
            # code...
			return View('page.dangnhap',compact('req'))->withErrors($validate);
		}
		else{
			$data = array('email'=>$req->email,'password'=>$req->password);
			if (Auth::guard('nguoidung')->attempt($data,$req->remember)) {
                # code...
				return redirect()->route('trang-chu')->with(['flag'=>'success','thongbao'=>'đăng nhập thành công','islogin'=>'yes']);
			}
			else {
				return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Email hoặc mật khẩu không đúng'])->withInput($req->only('email','remember'));
			}
		}
	}
}
