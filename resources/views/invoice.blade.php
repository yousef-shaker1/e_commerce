<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Invoice</title>
    <style>
        body {
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 17px; /* حجم الخط الأصغر */
            font-family: 'Amiri', sans-serif;
            direction: rtl; /* صفحة RTL بالكامل */
            text-align: right;
        }

        .ltr-text {
            direction: ltr;
            text-align: left;
        }
        .rtl-text {
            direction: rtl;
            text-align: right;
        }
        .invoice-container {
            padding: 24px;
            max-width: 750px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            page-break-inside: avoid; /* تجنب تقسيم الصفحة في الطباعة */
        }

        .header {
            text-align: center;
            margin-bottom: 17px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .details {
            margin-bottom: 15px;
        }

        .details p {
            margin: 3px 0;
            font-size: 14px;
            color: #555;
        }

        .details .label {
            font-weight: bold;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        .invoice-table th {
            background-color: #007bff;
            color: white;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .summary, .notes {
            margin-top: 15px;
            font-size: 12px;
        }

        .summary p, .notes p {
            margin: 3px 0;
        }

        .summary {
            padding-top: 10px;
            border-top: 2px solid #007bff;
        }

        .notes {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f4f4f4;
        }

        .qr-code {
            text-align: center;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 3px 0;
        }

        .invoice-header {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

      
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Order Invoice</h1>
            <p>Invoice Date: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        </div>
        <div class="details">
            <p><span class="label">Order Number:</span> {{ $order->id }}</p>
            <p><span class="label">Customer Name:</span> {{ $order->customer->name }}</p>
            <p><span class="label">Order Date:</span> {{ $order->day }}</p>
        </div>
        <table class="invoice-table">
            <thead> 
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (USD)</th>
                    <th>Total (USD)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->count }}</td>
                    <td>{{ $order->product->price }}</td>
                    <td>{{ $order->count * $order->product->price }}</td>
                </tr>
            </tbody>
        </table>
        <div class="summary">
            <p><strong>Subtotal:</strong> {{ $order->count * $order->product->price }} USD</p>
            <p><strong>Tax (Included):</strong> 0 USD</p>
            <p><strong>Discount:</strong> 0 USD</p>
            <p><strong>Total Amount:</strong> {{ $order->count * $order->product->price }} USD</p>
        </div>
        <div class="notes">
            <p><strong>Notes:</strong></p>
            <p>1. Please keep this invoice for your records.</p>
            <p>2. For any queries, contact us at the provided email or phone number.</p>
            <p>3. The delivery date may vary depending on the location and availability.</p>
        </div>
        <div class="qr-code">
            <img src="data:image/png;base64, {{ $qrCodeImage }}" alt="QR Code">
        </div>
        <div class="footer">
            <p>Thank you for shopping with us!</p>
            <p>Address: 1234 Shopping Street, City, Country</p>
            <p>Phone Number: 123-456-7890</p>
            <p>Expected Delivery Date: {{ $order->day }}</p>
            <p>Email: youssefshaker2cool@gmail.com</p>
        </div>
    </div>
</body>
</html>
