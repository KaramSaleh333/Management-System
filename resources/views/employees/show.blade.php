<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=800, initial-scale=1" />
    <title>ادارة الموظفين</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .container {
            margin-top: 60px; /* Adjust according to your navbar height */
            padding: 20px;
        }

        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .employee-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .employee-table th,
        .employee-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: right; /* Adjust text alignment */
        }

        .employee-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .employee-table td {
            background-color: #fff;
        }

        .employee-table td.email {
            color: #007bff;
        }

        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
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
        .search-container input[type="date"],
        .search-container input[type="tel"] {
            display: none; /* Initially hide all input fields */
            padding: 10px;
            width: 200px; /* Adjust width as needed */
            border: 2px solid #007bff; /* Adjust border color to match theme */
            background-color: transparent;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-container button[type="submit"] {
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

        .search-container button[type="submit"]:hover {
            background-color: #007bb6;
        }

        .button1,
        .red-submit {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .button1 {
            background-color: #0074D9;
            color: white;
            margin-right: 5px;
        }

        .button1:hover {
            background-color: #0056b3;
        }

        .red-submit {
            background-color: red;
            color: white;
            border: none;
        }

        .red-submit:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="{{route('employee.show')}}" method="post">
        @csrf
        <div class="search-container">
            <label for="search">اختر طريقة البحث :</label>
            <select name="search" id="search" onchange="toggleTextInput(this)">
                <option value=""></option>
                <option value="option1">اسم الموظف</option>
                <option value="option2">اسم المستخدم</option>
                <option value="option3">الوظيفة</option>
                <option value="option4">المرتب اكثر من او يساوي</option>
                <option value="option5">تاريخ الانضمام</option>
                <option value="option6">المدينة</option>
                <option value="option7">رقم الموبايل</option>
            </select>
            <input type="text" name="name" id="name" placeholder="ادخل اسم الموظف" style="display: none;">
            <input type="text" name="user_name" id="user_name" placeholder="ادخل اسم المستخدم للموظف" style="display: none;">
            <input type="text" name="role" id="role" placeholder="ادخل الوظيفة" style="display: none;">
            <input type="number" name="salary" id="salary" placeholder="ادخل المرتب" style="display: none;">
            <input type="date" name="created_at" id="created_at" placeholder="ادخل تاريخ الانضمام" style="display: none;">
            <input type="text" name="city" id="city" placeholder="ادخل المدينة" style="display: none;">
            <input type="tel" name="telephone" id="telephone" placeholder="ادخل رقم الموظف" style="display: none;">
            <button type="submit">بحث</button>
        </div>
    </form>

    @if(auth()->user()->role == 'المالك')
        <div class="search-container">
            <a href="{{ route('register') }}" class="button1">اضافة موظف</a>
        </div>
    @endif

    <table class="employee-table">
        <thead>
            <tr>
                <th>اسم الموظف</th>
                <th>اسم المستخدم</th>
                <th>الوظيفة</th>
                <th>رقم الموبايل</th>
                <th>المدينة</th>
                <th>المرتب</th>
                <th>تاريخ الانضمام</th>
                @if(auth()->user()->role == 'المالك')
                    <th>التحكم</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                @if($employee->role == 'المالك')
                    @continue
                @endif
                <tr>
                    <td>{{$employee->name}}</td>
                    <td class="email">{{$employee->user_name}}</td>
                    <td>{{$employee->role}}</td>
                    <td>{{$employee->telephone}}</td>
                    <td>{{$employee->city}}</td>
                    <td>{{$employee->salary}}</td>
                    <td>{{date_format($employee->created_at , "Y:m:d")}}</td>
                    @if(auth()->user()->role == 'المالك')
                        <td>
                            <form action="{{route('employee.destroy' , $employee->id)}}" method="post">
                                @csrf
                                @method('Delete')
                                <a href="{{route('employee.edit' , $employee->id)}}" class="button1">تعديل</a>
                                <input type="submit" class="red-submit" value="حذف">
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
        function toggleTextInput(selectElement) {
            var nameInput = document.getElementById("name");
            var user_nameInput = document.getElementById("user_name");
            var roleInput = document.getElementById("role");
            var salaryInput = document.getElementById("salary");
            var created_atInput = document.getElementById("created_at");
            var cityInput = document.getElementById("city");
            var telephoneInput = document.getElementById("telephone");

            // Hide all input fields
            nameInput.style.display = "none";
            user_nameInput.style.display = "none";
            roleInput.style.display = "none";
            salaryInput.style.display = "none";
            created_atInput.style.display = "none";
            cityInput.style.display = "none";
            telephoneInput.style.display = "none";

            // Show the selected input field based on the selected option
            switch (selectElement.value) {
                case "option1":
                    nameInput.style.display = "inline-block";
                    break;
                case "option2":
                    user_nameInput.style.display = "inline-block";
                    break;
                case "option3":
                    roleInput.style.display = "inline-block";
                    break;
                case "option4":
                    salaryInput.style.display = "inline-block";
                    break;
                case "option5":
                    created_atInput.style.display = "inline-block";
                    break;
                case "option6":
                    cityInput.style.display = "inline-block";
                    break;
                case "option7":
                    telephoneInput.style.display = "inline-block";
                    break;
                default:
                    break;
            }
        }
    </script>

</body>
</html>
</x-app-layout>
