<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);

Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChiTietSp'
]);

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

Route::get('add-to-cart/{id}/{sl}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);

Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getCheckout'
]);

Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'
]);

Route::get('dang-ki',[
	'as'=>'signup',
	'uses'=>'PageController@getSignup'
]);

Route::post('dang-ki',[
	'as'=>'signup',
	'uses'=>'PageController@postSignup'
]);

Route::get('sua-thong-tin',[
    'as'=>'editprofile',
    'uses'=>'PageController@getEditProfile'
]);

Route::post('sua-thong-tin',[
    'as'=>'editprofile',
    'uses'=>'PageController@postEditProfile'
]);

Route::get('chi-tiet-don-hang/{id}',[
    'as'=>'chitietdonhang',
    'uses'=>'PageController@getBillDetail'
]);

Route::get('dang-xuat',[
	'as'=>'logout1',
	'uses'=>'PageController@postLogout'
]);

Route::post('dang-nhap',[
	'as'=>'loginpage',
	'uses'=>'PageController@postLogin'
]);

Route::get('dang-nhap',[
	'as'=>'loginpage',
	'uses'=>'PageController@getLogin'
]);


Route::get('tim-kiem',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);

Route::post('binh-luan/{id}',[
	'as'=>'comment',
	'uses'=>'PageController@postComment'
]);

Route::get('xoa-binh-luan/{id}',[
    'as'=>'deletecomment',
    'uses'=>'PageController@getDeleteComment'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('admin/login',[
    'as'=>'loginadmin',
    'uses'=>'AdminUserController@getLoginAdmin'
]);

Route::post('admin/login',[
    'as'=>'loginadmin',
    'uses'=>'AdminUserController@postLoginAdmin'
]);

Route::get('admin/logout',[
    'as'=>'logoutadmin',
    'uses'=>'AdminUserController@getLogoutAdmin'
]);

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function (){
    Route::group(['prefix'=>'type_products'],function (){
        Route::get('danhsach',['as'=>'danhsachloaisp','uses'=>'AdminProductTypeController@getLoaiSP']);

        Route::get('sua/{id}',['as'=>'sualoaisp','uses'=>'AdminProductTypeController@getSuaLoaiSP']);
        Route::post('sua/{id}',['as'=>'sualoaisp','uses'=>'AdminProductTypeController@postSuaLoaiSP']);

        Route::get('them',['as'=>'themloaisp','uses'=>'AdminProductTypeController@getThemLoaiSP']);
        Route::post('them',['as'=>'themloaisp','uses'=>'AdminProductTypeController@postThemLoaiSP']);

        Route::get('xoa/{id}',['as'=>'xoaloaisp','uses'=>'AdminProductTypeController@getXoaLoaiSP']);
    });

    Route::group(['prefix'=>'slide'],function (){
        Route::get('danhsach',['as'=>'danhsachslide','uses'=>'AdminSlideTypeController@getSlide']);

        Route::get('sua/{id}',['as'=>'suaslide','uses'=>'AdminSlideTypeController@getSuaSlide']);
        Route::post('sua/{id}',['as'=>'suaslide','uses'=>'AdminSlideTypeController@postSuaSlide']);

        Route::get('them',['as'=>'themslide','uses'=>'AdminSlideTypeController@getThemSlide']);
        Route::post('them',['as'=>'themslide','uses'=>'AdminSlideTypeController@postThemSlide']);

        Route::get('xoa/{id}',['as'=>'xoaslide','uses'=>'AdminSlideTypeController@getXoaSlide']);
    });

    Route::group(['prefix'=>'users'],function (){
        Route::get('danhsach',['as'=>'danhsachuser','uses'=>'AdminUserController@getUser']);

        Route::get('sua/{id}',['as'=>'suauser','uses'=>'AdminUserController@getSuaUser']);
        Route::post('sua/{id}',['as'=>'suauser','uses'=>'AdminUserController@postSuaUser']);

        Route::get('them',['as'=>'themuser','uses'=>'AdminUserController@getThemUser']);
        Route::post('them',['as'=>'themuser','uses'=>'AdminUserController@postThemUser']);

        Route::get('xoa/{id}',['as'=>'xoauser','uses'=>'AdminUserController@getXoaUser']);
        Route::get('xoahan/{id}',['as'=>'xoahanuser','uses'=>'AdminUserController@getXoaHanUser']);

        Route::get('thayquyen/{id}',['as'=>'thayquyenuser','uses'=>'AdminUserController@getThayQuyenUser']);
    });

    Route::group(['prefix'=>'bills'],function (){
        Route::get('danhsach',['as'=>'danhsachbill','uses'=>'AdminBillController@getBill']);

        Route::get('xuly/{id}',['as'=>'xulybill','uses'=>'AdminBillController@getXuLyBill']);

        Route::get('chitiet/{id}',['as'=>'chitietbill','uses'=>'AdminBillController@getChiTietBill']);
    });

    Route::group(['prefix'=>'products'],function (){
        Route::get('danhsach',['as'=>'danhsachproduct','uses'=>'AdminProductController@getProduct']);

        Route::get('sua/{id}',['as'=>'suaproduct','uses'=>'AdminProductController@getSuaProduct']);
        Route::post('sua/{id}',['as'=>'suaproduct','uses'=>'AdminProductController@postSuaProduct']);

        Route::get('them',['as'=>'themproduct','uses'=>'AdminProductController@getThemProduct']);
        Route::post('them',['as'=>'themproduct','uses'=>'AdminProductController@postThemProduct']);

        Route::get('xoa/{id}',['as'=>'xoaproduct','uses'=>'AdminProductController@getXoaProduct']);
        Route::get('xoahan/{id}',['as'=>'xoahanproduct','uses'=>'AdminProductController@getXoaHanProduct']);
    });
});