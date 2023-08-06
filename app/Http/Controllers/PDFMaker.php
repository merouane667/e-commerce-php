<?php

namespace App\Http\Controllers;
use PDF;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDFMaker extends Controller
{
    function gen(){
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)->get();
        $Orderedproducts = Order::where('user_id', $userId)->pluck('products');
        $JsonString = $Orderedproducts[0];
        $array = json_decode($JsonString, true);

        $user_name = auth()->user()->name;
        $order_id = $orders->pluck('payment_intent_id');
        $order_date = $orders->pluck('payment_created_at');
        $calculated_total = intval(substr($array['product_0'][1],0,-2))*intval($array['product_0'][2]);
        $calculated_total_and_ship = intval(substr($array['product_0'][1],0,-2))*intval($array['product_0'][2])+20;
        $total_price = substr($orders->pluck('amount'), 1, -3);
        $data = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Invoice</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    text-align: left;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                }
                h1 {
                    text-align: center;
                }
                .invoice-details {
                    margin-bottom: 20px;
                }
                .shipping-details {
                    margin-top: 20px;
                    margin-bottom: 20px;
                }
                .amount-details {
                    text-align: right;
                }
            </style>
        </head>
        <body>
            <h1>Invoice</h1>
            <div class="invoice-details">
                <p><strong>Company Name:</strong> Larashop Corporation</p>
                <p><strong>User Name:</strong> '.$user_name.'</p>
                <p><strong>Order ID:</strong> '.substr($order_id, 2, -2).'</p>
                <p><strong>Phone Number:</strong> 555-1234</p>
                <p><strong>Date:</strong> '.substr($order_date, 2, -2).'</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>'.$array['product_0'][0].'</td>
                        <td>'.$array['product_0'][2].'</td>
                        <td> $'.substr($array['product_0'][1],0,-2).'</td>
                        <td> $'.$calculated_total.'</td>
                    </tr>

                </tbody>
            </table>
            <div class="shipping-details">
                <p><strong>Shipping Address:</strong></p>
                <p>John Doe</p>
                <p>123 Main St.</p>
                <p>Anytown, USA 12345</p>
            </div>
            <div class="amount-details">
                <p><strong>Subtotal:</strong> $'.$calculated_total.'</p>
                <p><strong>Shipping:</strong> $20</p>
                <p><strong>Total:</strong> $'.$calculated_total_and_ship.'</p>
            </div>
        </body>
        </html>
        ';
        $pdf = PDF::loadHTML($data);
        return $pdf->stream();
    }
}
