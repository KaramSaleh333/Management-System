<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انشاء الفواتير</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f0f0f0;
        }

        .container {
            margin-top: 60px; /* Adjust according to your navbar height */
            padding: 20px;
        }

        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center; /* Center items vertically */
            margin-bottom: 20px;
        }

        .button1, .button2 {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .button1 {
            background-color: #0074D9;
            margin-right: 5px;
        }

        .button2 {
            background-color: #0074D9;
            margin-left: 5px;
        }

        .button1:hover, .button2:hover {
            background-color: #0056b3;
        }

        /* Invoice table styles */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: center;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .invoice-table td {
            background-color: #ffffff;
        }

        .invoice-table tfoot {
            font-weight: bold;
            text-align: right;
        }

        .invoice-table .total {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<x-app-layout>
    <div class="container">
        <div class="search-container">
            <a href="{{route('show_all')}}" class="button2">الفواتير</a>
            <a href="{{route('products.index')}}" class="button1">اضافة منتج للفاتورة</a>
        </div>

        <!-- Invoice table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>اسم المنتج</th>
                    <th>الكمية</th>
                    <th>السعر للوحدة</th>
                    <th>السعر الإجمالي</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($session))
                @php $total_price = 0 ;@endphp
                @foreach($session as $key=>$product)
                <tr>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['amount']}}</td>
                    <td>{{$product['price']}}</td>
                    <td>{{$product['price'] * $product['amount']}}</td>
                    <td><a href="{{route('Bill.destroy' , $key)}}"><i style="font-size:24px" class="fa">&#xf00d;</i></a></td>
                    @php $total_price += $product['price'] * $product['amount'] @endphp
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="3">المجموع</td>
                    <td>{{$total_price}}</td>
                    <td><a href="{{route('delete_all')}}">حذف الكل</a></td>
                </tr>
                @if($total_price != 0)
                <tr>
                    <td colspan="5"><a href="{{route('Bill.store' , $total_price)}}">تأكيد الفاتورة</a></td>
                </tr>
                @endif
            </tfoot>
            @endif
        </table>
    </div>
</x-app-layout>
</body>
</html>
