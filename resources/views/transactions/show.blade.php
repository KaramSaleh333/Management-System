<x-app-layout>
<!DOCTYPE html>
<html lang="ar" >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تاريخ التعديلات</title>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        margin: 0;
        background-color: #f7f7f7;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    .x-app-layout {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    .content {
        padding-top: 60px;
        direction: rtl;
    }
    hr {
      border: none; /* Remove default border */
      height: 5px; /* Set height of the line */
      background-color: #333; /* Choose a color for the line */
      margin: 20px 0; /* Add some margin for spacing */
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
        .search-container input[type="date"]{
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
</style>
</head>
<body>
<br>
<form action="{{ route('transaction.search') }}" method="post">
    @csrf
    <div class="search-container">
        <label for="search">اختر طريقة البحث :</label>
        <select name="search" id="search" onchange="toggleTextInput(this)">
            <option value=""></option>
            <option value="option1">اسم الموظف</option>
            <option value="option2">وصف العملية</option>
            <option value="option3">تاريخ العملية</option>
        </select>
        <input type="text" name="name" id="name" placeholder="ادخل اسم الوظف" style="display: none;">
        <input type="text" name="type" id="type" placeholder="ادخل وصف العملية" style="display: none;">
        <input type="date" name="created_at" id="created_at" style="display: none;">
        <button type="submit">بحث</button>
    </div>
</form>

<div class="content">
    <div class="header">
        <h1><strong>تاريخ التعديلات</strong></h1>
    </div>
    @foreach($transactions as $trans)
    <table>
        <thead>
            <tr>
                <th>اسم الموظف</th>
                <th>وصف العملية</th>
                <th>تاريخ العملية</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{$trans->agent_name}}</td>
                <td>{{$trans->transaction_name}}</td>
                <td>{{date_format($trans->created_at , 'Y/m/d h:i A')}}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>بيانات المعدل علية</th>
                <th>تفاصيل العملية</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if(isset(json_decode($trans->transaction_details)->name))
                <td>{{json_decode($trans->transaction_details)->name}}</td>
                @else
                <td></td>
                @endif
                <td>
                @if(strpos($trans->transaction_name , 'تعديل') >= 0)
                    @foreach(json_decode($trans->transaction_details)->قبل as $key=>$edit)
                        @if($key == 'updated_at')
                        @continue
                        @endif
                        <p>تم التعديل '{{$key}}' من : {{$edit}} </p>
                    @endforeach
                @endif

                @foreach(json_decode($trans->transaction_details)->بعد as $key=>$edit)
                    @if($key == 'updated_at')
                      @continue
                    @endif
                    <p>التعديل : @if($trans->bill_details) <a href="{{route('transaction.deleted_bill' ,['bill' => base64_encode($trans->bill_details)])}}">{{$edit}}</a>
                    @else {{$edit}} @endif </p>
                        
                @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    @endforeach
</div>
<script>
        function toggleTextInput(selectElement) {
            var nameInput = document.getElementById("name");
            var typeInput = document.getElementById("type");
            var created_atInput = document.getElementById("created_at");

            // Hide all input fields
            nameInput.style.display = "none";
            typeInput.style.display = "none";
            created_atInput.style.display = "none";

            // Show the selected input field based on the selected option
            switch (selectElement.value) {
                case "option1":
                    nameInput.style.display = "inline-block";
                    break;
                case "option2":
                    typeInput.style.display = "inline-block";
                    break;
                case "option3":
                    created_atInput.style.display = "inline-block";
                    break;
                default:
                    break;
            }
        }
    </script>
</body>
</html>
</x-app-layout>