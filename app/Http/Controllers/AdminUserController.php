<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use Session;
use Illuminate\Support\Facades\Route;

class AdminUserController extends Controller
{

    public function getUser(){
        $user = User::orderBy('level','asc')->orderBy('updated_at','desc')->paginate(4);
        return view('admin.users.danhsach',compact('user'));
    }

    public function getThemUser(){
        return view('admin.users.them');
    }

    public function postThemUser(Request $req){
        $validate = Validator::make($req->all(),
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'full_name'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'vui lòng nhập Email',
                'email.email'=>'không đúng định dạng email',
                'email.unique'=>'email đã có người sử dụng',
                'password.required'=>'vui lòng nhập mật khẩu',
                're_password.same'=>'mật khẩu không giống nhau',
                'password.min'=>'mật khẩu ít nhất 6 kí tự',
                'password.max'=>'mật khẩu nhiều nhất 20 kí tự'
            ]);
        if ($validate->fails()) {
            # code...
            return View('admin.users.them',compact('req'))->withErrors($validate);
        }
        else{
            $user = new User;
            $user->email = $req->email;
            $user->full_name = $req->full_name;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
            $user->address = $req->address;
            $user->level = $req->level;
            $user->save();
            return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã thêm mới user thành công');
        }
    }

    public function getSuaUser($id){
        $user = User::find($id);
        return view('admin.users.sua',compact('user'));
    }

    public function postSuaUser(Request $req,$id){
        $user = User::find($id);
        if ($user->email == $req->email){
            if ($req->password != ""){
                $validate = Validator::make($req->all(),
                    [

                        'password'=>'required|min:6|max:20',
                        'full_name'=>'required',
                        're_password'=>'required|same:password'
                    ],
                    [
                        'password.required'=>'vui lòng nhập mật khẩu',
                        're_password.same'=>'mật khẩu không giống nhau',
                        'password.min'=>'mật khẩu ít nhất 6 kí tự',
                        'password.max'=>'mật khẩu nhiều nhất 20 kí tự'
                    ]);
                if ($validate->fails()) {
                    # code...
                    return View('admin.users.sua',compact('req','user'))->withErrors($validate);
                }
                else{
                    $user->full_name = $req->full_name;
                    $user->password = Hash::make($req->password);
                    $user->phone = $req->phone;
                    $user->address = $req->address;
                    $user->level = $req->level;
                    $user->save();
                    return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã sửa tài khoản thành công');
                }
            }
            else{
                $user->full_name = $req->full_name;
                $user->phone = $req->phone;
                $user->address = $req->address;
                $user->level = $req->level;
                $user->save();
                return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã sửa tài khoản thành công');
            }
        }
        else {
            if ($req->password != ""){
                $validate = Validator::make($req->all(),
                    [
                        'email'=>'required|email|unique:users,email',
                        'password'=>'required|min:6|max:20',
                        'full_name'=>'required',
                        're_password'=>'required|same:password'
                    ],
                    [
                        'email.required'=>'vui lòng nhập Email',
                        'email.email'=>'không đúng định dạng email',
                        'email.unique'=>'email đã có người sử dụng',
                        'password.required'=>'vui lòng nhập mật khẩu',
                        're_password.same'=>'mật khẩu không giống nhau',
                        'password.min'=>'mật khẩu ít nhất 6 kí tự',
                        'password.max'=>'mật khẩu nhiều nhất 20 kí tự'
                    ]);
                if ($validate->fails()) {
                    # code...
                    return View('admin.users.sua',compact('req','user'))->withErrors($validate);
                }
                else{

                    $user->email = $req->email;
                    $user->full_name = $req->full_name;
                    $user->password = Hash::make($req->password);
                    $user->phone = $req->phone;
                    $user->address = $req->address;
                    $user->level = $req->level;
                    $user->save();
                    return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã cập nhật tài khoản thành công');
                }
            }
            else{
                $validate = Validator::make($req->all(),
                    [
                        'email'=>'required|email|unique:users,email',
                        'full_name'=>'required',
                    ],
                    [
                        'email.required'=>'vui lòng nhập Email',
                        'email.email'=>'không đúng định dạng email',
                        'email.unique'=>'email đã có người sử dụng'
                    ]);
                if ($validate->fails()) {
                    # code...
                    return View('admin.users.sua',compact('req','user'))->withErrors($validate);
                }
                else{

                    $user->email = $req->email;
                    $user->full_name = $req->full_name;
                    $user->phone = $req->phone;
                    $user->address = $req->address;
                    $user->level = $req->level;
                    $user->save();
                    return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã cập nhật tài khoản thành công');
                }
            }
        }

    }

    public function getXoaUser($id){
        $item = User::find($id);
        if ($item->status == 0){
            $item->status = 1;
        }
        else {
            $item->status = 0;
        }
        $item->save();
        return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã sửa user thành công');
    }

    public function getXoaHanUser($id){
        $item = Bill::where('id_customer',$id)->first();
        if(isset($item->id)){
            return redirect()->route('danhsachuser')->with('thatbai','Bạn không thể xóa user vì user đã có bill');
        }
        else{
            $user = User::find($id);
            $comment = Comment::where('id_user',$id)->get();
            foreach ($comment as $item){
                $item->delete();
            }
            $user->delete();
            return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã xóa user và comment của user thành công');
        }

    }

    public function getThayQuyenUser($id){
        $item = User::find($id);
        if ($item->level == 0){
            $item->level = 1;
        }
        else {
            $item->level = 0;
        }
        $item->save();
        return redirect()->route('danhsachuser')->with('thanhcong','Bạn đã sửa user thành công');
    }

    public function getLoginAdmin(){
        return View('admin.login');
    }
    public function postLoginAdmin(Request $req){
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
            return View('admin.login',compact('req'))->withErrors($validate);
        }
        else{
            $data = array('email'=>$req->email,'password'=>$req->password,'level' => 1,'status' => 0);
            if (Auth::attempt($data)) {
                # code...

                return redirect(Session::has('preRoute')?Session::get('preRoute'):'admin/type_products/danhsach')->with('thanhcong','đăng nhập thành công');
            }
            else {
                return View('admin.login',compact('req'))->withErrors("email hoặc password không đúng");
            }
        }
    }

    public function getLogoutAdmin(){
        $currentPath = url()->previous();
        Session::put('preRoute',$currentPath);
        Auth::logout();
        return redirect('admin/login');
    }
}
    