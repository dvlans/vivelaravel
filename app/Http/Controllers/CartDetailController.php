<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request){        
        if(auth()->user()){

        	$cartDetail = new CartDetail();
        	$cartDetail->cart_id = auth()->user()->cart->id;
        	$cartDetail->product_id = $request->product_id;
        	$cartDetail->quantity = $request->quantity;
        	$cartDetail->save();

            $notificationHead = "Sistema:";
            $notification = 'El producto se ha cargado correctamente a tu carrito de compras.';

        	return back()->with(compact('notification'));
        }else{
            $notificationHead = 'Sistema:';
            $notificationFail = 'El producto no se puede agregar al carrito, debe iniciar sesión';
            return back()->with(compact('notificationFail','notificationHead'));
        }
    }


    public function destroy(Request $request){
    	$cartDetail = CartDetail::find($request->cart_detail_id);
        
        if ($cartDetail->cart_id == auth()->user()->cart->id)
    	   $cartDetail->delete();

        $notification = 'El producto se ha eliminado correctamente del carrito de compras.';
    	return back()->with(compact('notification'));

    }
}
