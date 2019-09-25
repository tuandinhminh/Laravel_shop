<?php

namespace App\Http\Controllers;

use App\Slide;
use Validator;
use Illuminate\Http\Request;


class AdminSlideTypeController extends Controller
{
    public function getSlide(){
        $slide = Slide::orderBy('id','desc')->paginate(4);
        return view('admin.slide.danhsach',compact('slide'));
    }

    public function getThemSlide(){
        return view('admin.slide.them');
    }

    public function postThemSlide(Request $req){
        $validate = Validator::make($req->all(),
            [
                'image'=>'required'
            ],
            [
                'image.required'=>'vui lòng chọn hình ảnh'
            ]);
        if ($validate->fails()) {
            # code...
            return View('admin.slide.them',compact('req'))->withErrors($validate);
        }
        else{
            $slide = new Slide();
            $slide->link = $req->link;
            if ($req->hasFile('image')){
                $file = $req->file('image');
                $type = $file->getClientOriginalExtension();
                if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                    return View('admin.slide.them',compact('req'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                }
                $name = $file->getClientOriginalName();
                $image = str_random(4)."_".$name;
                while (file_exists('source/image/slide'.$image)){
                    $image = str_random(4)."_".$name;
                }
                $file->move('source/image/slide',$image);
                $slide->image = $image;
            }
            else {
                $slide->image = "";
            }
            $slide->save();
            return redirect()->route('danhsachslide')->with('thanhcong','Bạn đã thêm mới slide thành công');
        }
    }

    public function getSuaSlide($id){
        $slide = Slide::find($id);

        return view('admin.slide.sua',compact('slide'));
    }

    public function postSuaSlide(Request $req,$id){
        $slide = Slide::find($id);


            $slide->link = $req->link;

            if ($req->hasFile('image')){
                $file = $req->file('image');
                $type = $file->getClientOriginalExtension();
                if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'JPG' && $type != 'PNG' && $type != 'JPEG'){
                    return View('admin.slide.them',compact('req','slide'))->withErrors('Định dạng ảnh bạn chọn không phù hợp ');
                }
                $name = $file->getClientOriginalName();
                $image = str_random(4)."_".$name;
                while (file_exists('source/image/slide'.$image)){
                    $image = str_random(4)."_".$name;
                }
                $file->move('source/image/slide',$image);
                $slide->image = $image;
            }
            $slide->save();
            return redirect()->route('danhsachslide')->with('thanhcong','Bạn đã sửa slide thành công');


    }

    public function getXoaSlide($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->route('danhsachslide')->with('thanhcong','Bạn đã xóa slide thành công');
    }
}
