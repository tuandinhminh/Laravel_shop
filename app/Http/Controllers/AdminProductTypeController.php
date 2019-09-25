<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Validator;
use Auth;
class AdminProductTypeController extends Controller
{
    public function getLoaiSP(){
        $loaisp = ProductType::orderBy('updated_at','desc')->paginate(4);
        return view('admin.type_products.danhsach',compact('loaisp'));
    }

    public function getThemLoaiSP(){
        return view('admin.type_products.them');
    }

    public function postThemLoaiSP(Request $req){
        $validate = Validator::make($req->all(),
            [
                'name'=>'required|unique:type_products,name',
                'image'=>'required'
            ],
            [
                'name.required'=>'vui lòng nhập tên',
                'name.unique'=>'tên loại sản phẩm đã được sử dụng',
                'image.required'=>'vui lòng chọn hình ảnh'
            ]);
        if ($validate->fails()) {
            # code...
            return View('admin.type_products.them',compact('req'))->withErrors($validate);
        }
        else{
            $typeproduct = new ProductType();
            $typeproduct->name = $req->name;
            $typeproduct->description = $req->description;
            if ($req->hasFile('image')){
                $file = $req->file('image');
                $type = $file->getClientOriginalExtension();
                if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                    return View('admin.type_products.them',compact('req'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                }
                $name = $file->getClientOriginalName();
                $image = str_random(4)."_".$name;
                while (file_exists('source/image/product'.$image)){
                    $image = str_random(4)."_".$name;
                }
                $file->move('source/image/product',$image);
                $typeproduct->image = $image;
            }
            else {
                $typeproduct->image = "";
            }
            $typeproduct->save();
            return redirect()->route('danhsachloaisp')->with('thanhcong','Bạn đã thêm mới loại sản phẩm thành công');
        }
    }

    public function getSuaLoaiSP($id){
        $loaisp = ProductType::find($id);

        return view('admin.type_products.sua',compact('loaisp'));
    }

    public function postSuaLoaiSP(Request $req,$id){
        $loaisp = ProductType::find($id);
        $typeproduct = ProductType::find($id);
        if ($typeproduct->name == $req->name){
            $typeproduct->name = $req->name;

            if ($req->hasFile('image')){
                $file = $req->file('image');
                $type = $file->getClientOriginalExtension();
                if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                    return View('admin.type_products.them',compact('req','loaisp'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                }
                $name = $file->getClientOriginalName();
                $image = str_random(4)."_".$name;
                while (file_exists('source/image/product'.$image)){
                    $image = str_random(4)."_".$name;
                }
                $file->move('source/image/product',$image);
                unlink('source/image/product/'.$typeproduct->image);
                $typeproduct->image = $image;
            }
            $typeproduct->description = $req->description;
            $typeproduct->save();
            return redirect()->route('danhsachloaisp')->with('thanhcong','Bạn đã sửa loại sản phẩm thành công');
        }
        else {
            $validate = Validator::make($req->all(),
                [
                    'name'=>'required|unique:type_products,name',
                ],
                [
                    'name.required'=>'vui lòng nhập tên',
                    'name.unique'=>'tên loại sản phẩm đã được sử dụng'
                ]);
            if ($validate->fails()) {
                # code...
                return View('admin.type_products.sua',compact('req','loaisp'))->withErrors($validate);
            }
            else{

                $typeproduct->name = $req->name;

                if ($req->hasFile('image')){
                    $file = $req->file('image');
                    $type = $file->getClientOriginalExtension();
                    if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                        return View('admin.type_products.them',compact('req','loaisp'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                    }
                    $name = $file->getClientOriginalName();
                    $image = str_random(4)."_".$name;
                    while (file_exists('source/image/product'.$image)){
                        $image = str_random(4)."_".$name;
                    }
                    $file->move('source/image/product',$image);
                    $typeproduct->image = $image;
                }
                $typeproduct->description = $req->description;
                $typeproduct->save();
                return redirect()->route('danhsachloaisp')->with('thanhcong','Bạn đã thêm mới loại sản phẩm thành công');
            }
        }

    }

    public function getXoaLoaiSP($id){
        $loaisp = ProductType::find($id);
        if ($loaisp->status == 0){
            $loaisp->status = 1;
        }
        else {
            $loaisp->status = 0;
        }
        $loaisp->save();
        return redirect()->route('danhsachloaisp')->with('thanhcong','Bạn đã sửa loại sản phẩm thành công');
    }


}
