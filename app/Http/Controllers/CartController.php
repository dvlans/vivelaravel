<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cart;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;

class CartController extends Controller
{
    public function update(Request $request){
    	if( auth()->user()->cart->details->count() == 0){
	    	$notificationHead = 'Sistema:';
            $notificationFail = 'El carrito no se puede procesar, debe agregar un producto';
            return back()->with(compact('notificationFail','notificationHead'));
    	}else {
            $client = auth()->user();
    		$cart = $client->cart;
	    	$cart->status = 'Pending';
            $cart->order_date = Carbon::now();
	    	$cart->save(); //UPDATE 

            $admins = User::where('admin', true)->get();

            Mail::to($admins)->send(new NewOrder($client, $cart));


	    	$notificationHead = 'Pedido registrado:';
	    	$notification = 'Tu pedido se ha registrado exitosamente. Te contactaremos pronto vía mail.';
	    	return back()->with(compact('notification', 'notificationHead'));
    	}
    }
}





