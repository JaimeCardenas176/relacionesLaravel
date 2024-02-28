<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    //dame el usuario de un pedido ok????
    public function getUserFromOrder($idPedido){

        $order = Order::where('id', '=', $idPedido); //eso mee va a devolver un pedido
        $user = $pedido->user();
        return $user;
    }
}
