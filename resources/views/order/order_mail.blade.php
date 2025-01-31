<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Main</title>
</head>
<body>
    <h1>Dear Sir,</h1>
    <p>A new order has been placed. Please check the details below:</p>

    <p>Name: {{ $order_data->name }}</p>
    <p>Phone: {{ $order_data->phone }}</p>
    <p>Apollo URL: {{ $order_data->apollo_url }}</p>
    <p>Total Lead: {{ $order_data->total_lead }}</p>
    <p>Additional Links: {{ $order_data->additional_url }}</p>
    <p>Additional Amount: {{ $order_data->additional_amount }}$</p>
    <p>Total Amount: {{ $order_data->total_amount }}$</p>

    <p>This is a system generated email.</p>
</body>
</html>