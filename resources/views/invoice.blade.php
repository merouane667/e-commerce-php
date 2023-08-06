<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        /* Your custom styles for the invoice */
    </style>
</head>
<body>
    <h1>Invoice</h1>
    <p>Company Name: {{ $company_name }}</p>
    <p>User Name: {{ $user_name }}</p>
    <p>Order ID: {{ $order_id }}</p>
    <p>Phone Number: {{ $phone_number }}</p>
    <p>Shipping Address: {{ $shipping_address }}</p>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total: {{ $total }}</p>
    <p>Date: {{ $date }}</p>
</body>
</html>
