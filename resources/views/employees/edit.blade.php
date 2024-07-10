<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تعديل بيانات موظف</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #4070f4;
    }

    .wrapper {
      position: relative;
      max-width: 430px;
      width: 100%;
      background: #fff;
      padding: 34px;
      border-radius: 6px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .wrapper h2 {
      position: relative;
      font-size: 22px;
      font-weight: 600;
      color: #333;
    }

    .wrapper h2::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 28px;
      border-radius: 12px;
      background: #4070f4;
    }

    .wrapper form {
      margin-top: 30px;
    }

    .input-box {
      margin-bottom: 18px; /* Space between input boxes */
    }

    .input-box input,
    .input-box select {
      height: 52px;
      width: 100%;
      outline: none;
      padding: 0 15px;
      font-size: 17px;
      font-weight: 400;
      color: #333;
      border: 1.5px solid #C7BEBE;
      border-bottom-width: 2.5px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .input-box input:focus,
    .input-box input:valid,
    .input-box select:focus,
    .input-box select:valid {
      border-color: #4070f4;
    }

    .input-box.button input {
      color: #fff;
      letter-spacing: 1px;
      border: none;
      background: #4070f4;
      cursor: pointer;
    }

    .input-box.button input:hover {
      background: #0e4bf1;
    }

    .input-error {
      color: red;
      font-size: 14px;
      margin-top: 5px; /* Adjust spacing between input and error */
    }

    form .text h3 {
      color: #333;
      width: 100%;
      text-align: center;
    }

    form .text h3 a {
      color: #4070f4;
      text-decoration: none;
    }

    form .text h3 a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <h2>تعديل بيانات موظف</h2>
    
    <form method="POST" action="{{ route('employee.update', $employee->id) }}">
      @csrf
      @method('PUT')

      <div class="input-box">
        <input type="text" id="name" placeholder="الاسم" maxlength="255" value="{{$employee->name}}" name="name" required>
        <x-input-error :messages="$errors->get('name')" class="input-error" />
      </div>

      <div class="input-box">
        <select name="role" id="job" onchange="toggleTextInput(this)" required>
          <option value="{{$employee->role}}">{{$employee->role}}</option>
          <option value="محاسب">محاسب</option>
          <option value="كاشير">كاشير</option>
          <option value="other">آخر</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="input-error" />
        <input type="text" name="other_role" id="other_role" maxlength="255" placeholder="ادخل المسمي الوظيفي" style="display: none;">
        <x-input-error :messages="$errors->get('other_role')" class="input-error" />
      </div>
      
      <div class="input-box">
        <input type="number" placeholder="المرتب" maxlength="11" value="{{$employee->salary}}" name="salary" required>
        <x-input-error :messages="$errors->get('salary')" class="input-error" />
      </div>

      <div class="input-box">
        <input type="tel" id="telephone" placeholder="رقم الموبايل" minlength="11" maxlength="13" value="{{$employee->telephone}}" name="telephone" required> 
        <x-input-error :messages="$errors->get('telephone')" class="input-error" />
      </div>

      <div class="input-box">
        <input type="text" id="city" placeholder="المدينة" maxlength="255" value="{{$employee->city}}" name="city" required>
        <x-input-error :messages="$errors->get('city')" class="input-error" />
      </div>

      <div class="input-box button">
        <input type="submit" value="تأكيد">
      </div>

    </form>
  </div>

  <script>
    function toggleTextInput(selectElement) {
      var otherRoleInput = document.getElementById("other_role");

      // Hide all input fields
      otherRoleInput.style.display = "none";

      // Show the selected input field based on the selected option
      if (selectElement.value === "other") {
        otherRoleInput.style.display = "block";
      }
    }
  </script>
</body>
</html>
