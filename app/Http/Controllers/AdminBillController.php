<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use Illuminate\Http\Request;

class AdminBillController extends Controller
{
    public function getBill(){
        $bill = Bill::orderBy('status','asc')->paginate(7);
        return view('admin.bills.danhsach',compact('bill'));
    }

    public  function getXuLyBill($id){
        $bill = Bill::find($id);
        $bill->status = ($bill->status+1)%3;
        $bill->save();
        return redirect()->route('danhsachbill')->with('thanhcong','bạn đã xử lý hóa đơn thành công');
    }

    public function  getChiTietBill($id){
        $ctbill = BillDetail::where('id_bill',$id)->get();
        $bill = Bill::find($id);
        return view('admin.bills.danhsachct',compact('ctbill','bill'));
    }
}
