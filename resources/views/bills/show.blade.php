<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاريخ الفواتير</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000; /* Ensures it's above other content */
        }

        .container {
            max-width: 800px;
            margin: 80px auto 20px; /* Adjusted margin to accommodate navbar */
            padding: 20px;
            direction: rtl; /* Right-to-left direction for Arabic text */
            text-align: right; /* Align text to the right */
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative; /* Ensure relative positioning for absolute button */
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center; /* Center text in card header */
        }

        .card-header h2 {
            margin: 0;
            font-size: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .bill-info p {
            margin: 5px 0;
        }

        .details {
            margin-top: 20px;
        }

        .details h3 {
            margin-top: 0;
            font-size: 18px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 5px;
        }

        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 50px;
            align-items: center; /* Align items vertically */
        }

        .search-container label {
            margin-right: 10px; /* Add some spacing between label and select */
        }

        .search-container select {
            padding: 10px;
            width: 200px; /* Adjust width as needed */
            border: 2px solid #007bff; /* Adjust border color to match theme */
            background-color: transparent;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
            -webkit-appearance: none; /* Remove default appearance */
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E"); /* Add custom arrow */
            background-repeat: no-repeat;
            background-position-x: 95%; /* Position arrow on the right */
            background-position-y: center;
        }

        .search-container select:focus {
            border-color: dodgerblue;
        }

        .search-container input[type="text"],
        .search-container input[type="number"],
        .search-container input[type="date"] {
            display: none; /* Initially hide all input fields */
            padding: 10px;
            width: 200px; /* Adjust width as needed */
            border: 2px solid #007bff; /* Adjust border color to match theme */
            background-color: transparent;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-container button {
            padding: 10px 15px;
            background-color: dodgerblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .search-container button:hover {
            background-color: #007bb6;
        }

        /* Style for the "Return" button */
        .return-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: red;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .return-button:hover {
            background-color: darkred;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            direction: rtl; /* Right-to-left text direction */
        }
        
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        th {
            background-color: #f2f2f2;
            text-align: right;
        }
        
        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <br>
        <form action="{{ route('Bill.search') }}" method="post">
            @csrf
            <div class="search-container">
                <label for="search">اختر طريقة البحث :</label>
                <select name="search" id="search" onchange="toggleTextInput(this)">
                    <option value=""></option>
                    <option value="option1">اسم المستخدم</option>
                    <option value="option2">رقم الفاتورة</option>
                    <option value="option3">تاريخ الفاتورة</option>
                    <option value="option4">سعر الفاتورة</option>
                </select>
                <input type="text" name="agent_name" id="agent_name" placeholder="ادخل اسم المستخدم">
                <input type="number" name="id" id="id" placeholder="الخاص بالفاتورة id ادخل">
                <input type="date" name="created_at" id="created_at" placeholder="ادخل تاريخ الفاتورة">
                <input type="number" name="total_paid" id="total_paid" placeholder="ادخل سعر الفاتورة">
                <button type="submit">بحث</button>
            </div>
        </form>
        @if(isset($dayincome))
        <div>
            <table>
                <tr>
                    <td>الدخل خلال اليوم</td>
                    <td>{{$dayincome}}</td>
                </tr>
                <tr>
                    <td>الدخل خلال الشهر</td>
                    <td>{{$monthincome}}</td>
                </tr>
                <tr>
                    <td>الدخل خلال السنة</td>
                    <td>{{$yearincome}}</td>
                </tr>
            </table>
        </div>
        @endif
        <div class="container">
            @foreach($bills as $bill)
            <div class="card">
                <a href="{{route('delete_bill' , $bill->id)}}" class="return-button">ارجاع</a>
                <div class="card-header">
                    <h2><a href="{{ route('Bill.show', $bill->id) }}">تفاصيل الفاتورة</a></h2>
                </div>
                <div class="card-body">
                    <div class="bill-info">
                        <p><strong>المستخدم:</strong> {{$bill->agent_name}}</p>
                        <p><strong>رقم الفاتورة:</strong> {{$bill->id}}</p>
                        <p><strong>تاريخ الانشاء:</strong> {{date_format($bill->created_at ,'Y/m/d h:i A')}}</p>
                        <p><strong>المدفوع بالكامل:</strong> {{$bill->total_paid}}</p>
                    </div>
                    
                    <div class="details">
                        @php $i = 1; @endphp
                        @foreach(json_decode($bill->products_details) as $product)
                        <h3><strong>{{$i}} - </strong>{{$product->name}}</h3>
                        <ul>
                            <li>   {{$product->id}} <= id</li>
                            <li>الكمية: {{$product->amount}}</li>
                            <li>السعر: {{$product->price}}</li>
                        </ul>
                        <hr>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </x-app-layout>
    <script>
        function toggleTextInput(selectElement) {
            var agent_nameInput = document.getElementById("agent_name");
            var idInput = document.getElementById("id");
            var created_atInput = document.getElementById("created_at");
            var total_paidInput = document.getElementById("total_paid");

            // Hide all input fields
            agent_nameInput.style.display = "none";
            idInput.style.display = "none";
            created_atInput.style.display = "none";
            total_paidInput.style.display = "none";

            // Show the selected input field based on the selected option
            switch (selectElement.value) {
                case "option1":
                    agent_nameInput.style.display = "inline-block";
                    break;
                case "option2":
                    idInput.style.display = "inline-block";
                    break;
                case "option3":
                    created_atInput.style.display = "inline-block";
                    break;
                case "option4":
                    total_paidInput.style.display = "inline-block";
                    break;
                default:
                    break;
            }
        }
    </script>
</body>
</html>
