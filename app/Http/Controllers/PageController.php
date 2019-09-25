<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use App\Bill;
use App\BillDetail;
use App\User;
use App\Comment;
use Session;
use Hash;
use Illuminate\Http\Request;
use Validator;
use Auth;

class PageController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	$new_product = Product::orderBy('created_at','desc')->where('status',0)->take(4)->get();
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->where('status',0)->paginate(4);
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }

    public function getLoaiSp($type){
        $sp_theoloai = Product::where('id_type',$type)->where('status',0)->paginate(3);
        $sp_khac = Product::where('id_type','<>',$type)->where('status',0)->paginate(3);
        $loai = ProductType::where('status',0)->get();
        $loai_sp = ProductType::where('id',$type)->first();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChiTietSp(Request $req){
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->where('status',0)->where('id','<>',$req->id)->paginate(3);
        $binhluan = Comment::where('id_product','=',$req->id)->paginate(5);
        $bestseller = Product::orderBy('sold','desc')->where('status',0)->take(4)->get();
        $sanphammoi = Product::orderBy('created_at','desc')->where('status',0)->take(4)->get();
        return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','binhluan','bestseller','sanphammoi'));
    }

    public function getLienHe(){
    	return view('page.lienhe');
    }

    // gio hang
    public function getAddtoCart(Request $req,$id,$sl){

        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$id,$sl);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if($cart->totalQty > 0){
            Session::put('cart',$cart);
        }
        else {
            Session::forget('cart');
        }
        return redirect()->back();
    }
    // dat hang
    public function getCheckout(){
        return view('page.dat_hang');
    }

    public function postCheckout(Request $req){
        $cart = Session::get('cart');

        $user = User::where('email',$req->email)->first();
        $bill = new Bill;
        $bill->id_customer = $user->id;
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            # code...
            $bill_detail = new BillDetail;

            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();

            $soldproduct = Product::find($key);
            $soldproduct->sold += $value['qty'];
            $soldproduct->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','đặt hàng thành công');

    }

    // dang nhap
    public function getLogin(){
        if(Auth::check()){
            return redirect()->back()->with('thongbao','bạn đã đăng nhập rồi');
        }else
        return view('page.dangnhap');
    }

    public function postLogin(Request $req){
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
            $data = array('email'=>$req->email,'password'=>$req->password,'status'=>0);
            if (Auth::attempt($data)) {
                # code...
                return redirect()->route('trang-chu')->with(['flag'=>'success','thongbao'=>'đăng nhập thành công']);
            }
            else {
                return View('page.dangnhap',compact('req'))->withErrors('Email hoặc mật khẩu không đúng');
            }
        }

    }

    //dang ky
    public function getSignup(){
        if (Auth::check()) {
            return redirect()->back()->with('thongbao','bạn không được đăng ký khi đang đăng nhập');
        }
        return view('page.dangki');
    }

    public function postSignup(Request $req){

        $validate = Validator::make($req->all(),
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
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
            return View('page.dangki',compact('req'))->withErrors($validate);
        }
        else{
            $user = new User;
            $user->email = $req->email;
            $user->full_name = $req->fullname;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
            $user->address = $req->address;
            $user->save();
            return redirect()->route('loginpage')->with('thanhcong','Bạn đã tạo tài khoản thành công');
        }
    }

    public  function getEditProfile(){
        if(!Auth::check()){
            return redirect()->back()->with('thongbao','bạn chưa đăng nhập');
        }else{
            $bill = Bill::where('id_customer',Auth::user()->id)->orderBy('status','asc')->paginate(7);
            return view('page.suathongtin',compact('bill'));
        }

    }

    public function getBillDetail($id){
        $ctdh = BillDetail::where('id_bill',$id)->get();
        $bill = Bill::where('id_customer',Auth::user()->id)->paginate(7);
        return view('page.suathongtin',compact('ctdh','bill'));
    }

    public  function  postEditProfile(Request $req){
        $user = User::find(Auth::user()->id);
        if ($user->email == $req->email){
            if ($req->password != ""){
                $validate = Validator::make($req->all(),
                    [

                        'password'=>'required|min:6|max:20',
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
                    return View('page.suathongtin',compact('req'))->withErrors($validate);
                }
                else{
                    $user->full_name = $req->fullname;
                    $user->password = Hash::make($req->password);
                    $user->phone = $req->phone;
                    $user->address = $req->address;
                    $user->save();
                    return redirect()->back()->with('thanhcong','Bạn đã sửa tài khoản thành công');
                }
            }
            else{
                $user->full_name = $req->fullname;
                $user->phone = $req->phone;
                $user->address = $req->address;
                $user->save();
                return redirect()->back()->with('thanhcong','Bạn đã sửa tài khoản thành công');
            }
        }
        else {
            if ($req->password != ""){
                $validate = Validator::make($req->all(),
                    [
                        'email'=>'required|email|unique:users,email',
                        'password'=>'required|min:6|max:20',
                        'fullname'=>'required',
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
                    return View('page.suathongtin',compact('req'))->withErrors($validate);
                }
                else{

                    $user->email = $req->email;
                    $user->full_name = $req->fullname;
                    $user->password = Hash::make($req->password);
                    $user->phone = $req->phone;
                    $user->address = $req->address;
                    $user->save();
                    return redirect()->back()->with('thanhcong','Bạn đã cập nhật tài khoản thành công');
                }
            }
            else{
                $validate = Validator::make($req->all(),
                    [
                        'email'=>'required|email|unique:users,email',
                        'fullname'=>'required',
                    ],
                    [
                        'email.required'=>'vui lòng nhập Email',
                        'email.email'=>'không đúng định dạng email',
                        'email.unique'=>'email đã có người sử dụng'
                    ]);
                if ($validate->fails()) {
                    # code...
                    return View('page.suathongtin',compact('req'))->withErrors($validate);
                }
                else{

                    $user->email = $req->email;
                    $user->full_name = $req->fullname;
                    $user->phone = $req->phone;
                    $user->address = $req->address;
                    $user->save();
                    return redirect()->back()->with('thanhcong','Bạn đã cập nhật tài khoản thành công');
                }
            }
        }

    }

    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        return view('page.timkiem',compact('product'));
    }

    public function postComment(Request $req,$id){
        if (Auth::check()) {
            if (trim($req->contentComment) != "") {
                $comment = new Comment;
                $comment->id_user = Auth::user()->id;
                $comment->id_product = $id;
                $comment->content = $req->contentComment;
                $comment->save();
                return redirect()->back()->with('thongbao','bạn đã bình luận thành công');
            }
            else {
                return redirect()->back()->with('thongbao','bạn chưa viết bình luận');
            }
            
        }
        else {
            return redirect()->back()->with('thongbao','bạn phải đăng nhập để bình luận');
        }

    }

    public function getDeleteComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('thongbao','xóa bình luận thành công');
    }
}
