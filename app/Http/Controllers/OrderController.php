<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::query()->where('user_id', $user->id);

        // Verifica si se envió un status en la solicitud
        if (request('status')) {
            $status = request('status');

            // Si el status es 2, busca los que tienen status 2 o 3
            if ($status == 2) {
                $orders->whereIn('status', [2, 3]);
            }
            // Si el status es 6, busca los que tienen status >= 6
            elseif ($status == 6) {
                $orders->where('status', '>=', 6);
            }
            // Para otros casos, solo busca el status específico
            else {
                $orders->where('status', $status);
            }
        }

        // Obtener los resultados
        $orders = $orders->get();

        // Contadores de las órdenes según su estado
        $pendientes = Order::where('status', 1)
            ->where('user_id', $user->id)
            ->count();
        $recibido = Order::whereIn('status', [2, 3])
            ->where('user_id', $user->id)
            ->count();
        $enviado = Order::where('status', 4)
            ->where('user_id', $user->id)
            ->count();
        $entregado = Order::where('status', 5)
            ->where('user_id', $user->id)
            ->count();
        $anulado = Order::where('status', '>=', 6)
            ->where('user_id', $user->id)
            ->count();

        // Retornar la vista con los datos compactados
        return view('orders.index', compact('orders', 'pendientes', 'recibido', 'enviado', 'entregado', 'anulado'));
    }


    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }


    public function payment(Order $order)
    {
        $apiKey = config('services.bold.api_key');
        $secretKey = config('services.bold.secret_key');
        $currency = 'COP';
        /* $amount = intval($order->total * 100); */
        $amount = $order->total;
        $orderId = $order->public_order_number;

        $boldHashString = "{$orderId}{$amount}{$currency}{$secretKey}";
        $boldIntegritySignature = hash('sha256', $boldHashString);

        $boldCheckoutConfig = [
            'orderId' => $orderId,
            'currency' => $currency,
            'amount' => $amount,
            'apiKey' => $apiKey,
            'integritySignature' => $boldIntegritySignature,
            'description' => "Pago",
            /* 'tax' => 'vat-19', */
            'redirectionUrl' => config('services.bold.redirection_url'),
        ];

        return view('orders.payment', compact('order', 'boldCheckoutConfig'));
    }

    public function boldResponsePayment(Request $request)
    {

        $orderId = $request->input('bold-order-id');
        $status = $request->input('bold-tx-status');

        // Aquí puedes manejar la lógica según el estado de la transacción
        switch ($status) {
            case 'approved':
                $message = '¡Gracias por tu compra! Tu transacción ha sido aprobada.';
                // Puedes agregar más lógica, como enviar un correo de confirmación o actualizar el estado de la orden en la base de datos
                break;

            case 'processing':
                $message = 'Tu transacción está en proceso. Te notificaremos cuando se complete.';
                break;

            case 'pending':
                $message = 'Tu transacción está pendiente. Te notificaremos cuando se confirme.';
                break;

            case 'rejected':
                $message = 'Lo sentimos, tu transacción ha sido rechazada. Por favor, intenta nuevamente.';
                break;

            case 'failed':
                $message = 'Hubo un error en tu transacción. Por favor, intenta nuevamente.';
                break;

            default:
                $message = 'Estado de la transacción desconocido. Por favor, contacta con soporte.';
                break;
        }

        return view('orders.boldResponse', compact('orderId', 'status', 'message'));
    }


    public function boldHandlePaymentStatus(Request $request)
    {
        // Captura toda la información que llega por POST
        $data = $request->all();

        // Guarda la información en el campo 'texto'
        Test::create([
            'texto' => json_encode($data), // Guardamos la información en formato JSON
        ]);
    }
}
