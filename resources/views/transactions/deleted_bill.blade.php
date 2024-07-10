<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة بيع</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            direction: rtl; /* Right-to-left text direction */
        }
        /* Style for the entire page link */
        a {
            text-decoration: none; /* Remove underline */
            color: inherit; /* Inherit text color */
            cursor: default; /* Use default cursor */
            display: block; /* Make the entire area clickable */
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-header h2 {
            margin: 0;
        }
        .invoice-header p {
            margin: 5px 0;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .item-list {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .item-list th, .item-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-weight: normal; /* Remove bold font for table headers */
        }
        .item-list th {
            background-color: #f2f2f2;
        }
        .item-list td {
            font-size: 14px;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .total-section p {
            margin: 5px 0;
        }
        .store-name {
            text-align: center; /* Center align store name */
            font-size: 18px; /* Adjust font size */
            margin: 0; /* Remove any default margins */
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <div class="invoice-header">
        <div>
            <h2>فاتورة بيع</h2>
            <p>التاريخ: {{date_format(date_create('now') , 'Y/m/d')}}</p>
        </div>

        <div class="store-name">
            <p>Karam Store</p>
        </div>

        <div>
            <p>رقم الفاتورة: INV-{{$bill->id}}</p>
        </div>
    </div>

    <div class="invoice-details">
        <p><strong>العنوان:</strong> 123 شارع رئيسي، المدينة، البلد</p>
        <p><strong>البريد الإلكتروني:</strong> karam.saleh333@gmail.com</p>
    </div>

    <table class="item-list">
        <thead>
            <tr>
                <th>اسم السلعة</th>
                <th>الكمية</th>
                <th>سعر الوحدة</th>
                <th>الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach(json_decode($bill->products_details) as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->amount}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->price * $product->amount}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>المبلغ الإجمالي المستحق:</strong></td>
                <td><strong>{{$bill->total_paid}}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="total-section">
        <p><strong>المبلغ المستحق : </strong>{{$bill->total_paid}}</p>
        <p><strong>تاريخ الدفع :  </strong>{{date( 'Y/m/d h:i A',strtotime($bill->created_at))}}</p>
    </div>
</div>

</body>
</html>
