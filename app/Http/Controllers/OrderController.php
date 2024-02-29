<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Set a new order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setOrder(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'pickup_date' => 'required|date',
                'pickup_time' => 'required|date_format:H:i:s',
                'payment_method' => 'required|string',
            ]);

            // Obtener el usuario autenticado
            $user = $request->user();

            // Crear una nueva orden asociada al usuario autenticado
            $order = new Order();
            $order->pickup_date = $request->input('pickup_date');
            $order->pickup_time = $request->input('pickup_time');
            $order->payment_method = $request->input('payment_method');
            $order->user_id = $user->id;
            $order->save();

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to create order: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get order history with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        try {
            // Obtener el usuario autenticado
            $user = $request->user();
            echo $user;
            // Obtener la lista de órdenes del usuario paginadas
            $orders = Order::where('user_id', $user->id)->paginate(15);

            // Devolver la respuesta JSON con la lista de órdenes paginadas
            return response()->json($orders);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to retrieve order history: ' . $e->getMessage()], 500);
        }
    }
}
