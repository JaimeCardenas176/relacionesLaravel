<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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
                'user_id' => 'required|exists:users,id',
            ]);

            // Crear una nueva orden
            $order = new Order();
            $order->pickup_date = $request->input('pickup_date'); // Utilizar input() para acceder a los datos de la solicitud
            $order->pickup_time = $request->input('pickup_time'); // Utilizar input() para acceder a los datos de la solicitud
            $order->payment_method = $request->input('payment_method'); // Utilizar input() para acceder a los datos de la solicitud
            $order->user_id = $request->input('user_id'); // Utilizar input() para acceder a los datos de la solicitud
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
            // Obtener el ID de usuario de la solicitud
            $userId = $request->input('user_id');

            // Obtener la lista de órdenes del usuario paginadas
            $orders = Order::where('user_id', $userId)->paginate(15); // Filtrar órdenes por ID de usuario y paginar resultados

            // Devolver la respuesta JSON con la lista de órdenes paginadas
            return response()->json($orders);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to retrieve order history: ' . $e->getMessage()], 500);
        }
    }
}
