<?php

namespace App\Http\Controllers;

use App\BillDetail;
use App\Comment;
use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Validator;

class AdminProductController extends Controller
{
    public function getProduct(){
        $product = Product::orderBy('updated_at','desc')->paginate(4);
        return view('admin.products.danhsach',compact('product'));
    }

    public function getThemProduct(){
        $loaisp = ProductType::all();
        return view('admin.products.them',compact('loaisp'));
    }

    public function postThemProduct(Request $req){
        $loaisp = ProductType::all();
        $validate = Validator::make($req->all(),
            [
                'name'=>'required|unique:products,name',
                'image'=>'required',
                'id_type'=>'required',
                'unit_price'=>'required',
                'promotion_price'=>'required',
                'unit'=>'required'
            ],
            [
                'name.required'=>'vui lòng nhập tên',
                'name.unique'=>'tên loại sản phẩm đã được sử dụng',
                'image.required'=>'vui lòng chọn hình ảnh'
            ]);
        if ($validate->fails()) {
            # code...
            return View('admin.products.them',compact('req','loaisp'))->withErrors($validate);
        }
        else{
            $product = new Product();
            $product->id_type = $req->id_type;
            $product->name = $req->name;
            $product->description = $req->description;
            $product->unit_price = $req->unit_price;
            $product->promotion_price = $req->promotion_price;
            $product->unit = $req->unit;
            if ($req->hasFile('image')){
                $file = $req->file('image');
                $type = $file->getClientOriginalExtension();
                if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                    return View('admin.products.them',compact('req','loaisp'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                }
                $name = $file->getClientOriginalName();
                $image = str_random(4)."_".$name;
                while (file_exists('source/image/product'.$image)){
                    $image = str_random(4)."_".$name;
                }
                $file->move('source/image/product',$image);
                $product->image = $image;
            }
            else {
                $product->image = "";
            }
            $product->save();
            return redirect()->route('danhsachproduct')->with('thanhcong','Bạn đã thêm mới sản phẩm thành công');
        }
    }

    public function getSuaProduct($id){
        $bl = Comment::where('id_product',$id)->paginate(5);
        $sp = Product::find($id);
        $loaisp = ProductType::all();
        return view('admin.products.sua',compact('sp','loaisp','bl'));
    }

    public function postSuaProduct(Request $req,$id){
        $bl = Comment::where('id_product',$id)->paginate(5);
        $sp = Product::find($id);
        $loaisp = ProductType::all();
        $product = Product::find($id);
        if ($product->name == $req->name){

            $validate = Validator::make($req->all(),
                [
                    'id_type'=>'required',
                    'unit_price'=>'required',
                    'promotion_price'=>'required',
                    'unit'=>'required'
                ],
                [
                ]);
            if ($validate->fails()) {
                # code...
                return View('admin.products.sua',compact('req','loaisp','sp','bl'))->withErrors($validate);
            }
            else {
                if ($req->hasFile('image')) {
                    $file = $req->file('image');
                    $type = $file->getClientOriginalExtension();
                    if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG') {
                        return View('admin.type_products.them', compact('req','loaisp','sp','bl'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                    }
                    $name = $file->getClientOriginalName();
                    $image = str_random(4) . "_" . $name;
                    while (file_exists('source/image/product' . $image)) {
                        $image = str_random(4) . "_" . $name;
                    }
                    $file->move('source/image/product', $image);
                    unlink('source/image/product/' . $product->image);
                    $product->image = $image;
                }
                $product->id_type = $req->id_type;
                $product->description = $req->description;
                $product->unit_price = $req->unit_price;
                $product->promotion_price = $req->promotion_price;
                $product->unit = $req->unit;
                $product->save();
                return redirect()->route('danhsachproduct')->with('thanhcong', 'Bạn đã sửa sản phẩm thành công');
            }
        }
        else {
            $validate = Validator::make($req->all(),
                [
                    'name'=>'required|unique:products,name',
                    'id_type'=>'required',
                    'unit_price'=>'required',
                    'promotion_price'=>'required',
                    'unit'=>'required'
                ],
                [
                    'name.required'=>'vui lòng nhập tên',
                    'name.unique'=>'tên loại sản phẩm đã được sử dụng'
                ]);
            if ($validate->fails()) {
                # code...
                return View('admin.products.sua',compact('req','loaisp','sp','bl'))->withErrors($validate);
            }
            else{

                if ($req->hasFile('image')){
                    $file = $req->file('image');
                    $type = $file->getClientOriginalExtension();
                    if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                        return View('admin.type_products.them',compact('req','loaisp','sp','bl'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                    }
                    $name = $file->getClientOriginalName();
                    $image = str_random(4)."_".$name;
                    while (file_exists('source/image/product'.$image)){
                        $image = str_random(4)."_".$name;
                    }
                    $file->move('source/image/product',$image);
                    $product->image = $image;
                }
                $product->name = $req->name;
                $product->id_type = $req->id_type;
                $product->description = $req->description;
                $product->unit_price = $req->unit_price;
                $product->promotion_price = $req->promotion_price;
                $product->unit = $req->unit;
                $product->save();
                return redirect()->route('danhsachproduct')->with('thanhcong','Bạn đã sửa sản phẩm thành công');
            }
        }

    }

    public function getXoaProduct($id){
        $item = Product::find($id);
        if ($item->status == 0){
            $item->status = 1;
        }
        else {
            $item->status = 0;
        }
        $item->save();
        return redirect()->route('danhsachproduct')->with('thanhcong','Bạn đã sửa sản phẩm thành công');
    }

    public function getXoaHanProduct($id){
        $detail = BillDetail::where('id_product',$id)->first();
        if($detail){
            return redirect()->route('danhsachproduct')->with('thatbai','Bạn không xóa được sản phẩm vì còn Bill');
        }else{
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('danhsachproduct')->with('thanhcong','Bạn đã xóa sản phẩm thành công');
        }
    }

}
