<x-app-layout>
<style>
  /* CSS styles */
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
  }
  
  .container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
    justify-content: center;
  }
  
  .card {
    width: 300px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
  }
  
  .card-body {
    padding: 20px;
  }
  
  .card-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
  }
  
  .card-text {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
  }
  
  .price {
    font-size: 24px;
    font-weight: bold;
    color: #4070f4;
    margin-top: 10px;
  }
  
  .btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #4070f4;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    text-align: center;
    transition: background-color 0.3s ease;
  }
  
  .btn:hover {
    background-color: #0e4bf1;
  }
  .content {
      margin-left: 270px;
      padding: 20px;
    }
    
    .content h2 {
      color: #333;
    }
    
    .content p {
      color: #666;
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
        .search-container input[type="number"]{
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
.add-product-btn {
    display: inline-block;
    padding: 12px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    background-color: #1e90ff; /* Medium blue color */
    color: #fff; /* White text color */
    border: 1px solid #1e90ff; /* Medium blue border */
    border-radius: 4px; /* Rounded corners */
    transition: background-color 0.3s;
}

/* Hover state */
.add-product-btn:hover {
    background-color: #007acc; /* Darker blue on hover */
    border-color: #007acc;
}
.button1 {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0074D9;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
.red-submit {
  background-color: red;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.red-submit:hover {
  background-color: darkred;
}
.btn {
    display: block;
    width: 100%;
    padding: 12px 20px;
    background-color: #4CAF50; /* Green color */
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    text-align: center;
    transition: background-color 0.3s ease;
    margin-top: 10px;
    cursor: pointer;
  }
  
  .btn:hover {
    background-color: #45a049; /* Darker green on hover */
  }
</style>
<title>المخزن</title>

        <br>
        
        <form action="{{ route('products.search') }}" method="post">
            @csrf
            <div class="search-container">
                <label for="search">اختر طريقة البحث :</label>
                <select name="search" id="search" onchange="toggleTextInput(this)">
                    <option value=""></option>
                    <option value="option1">id</option>
                    <option value="option2">اسم المنتج</option>
                    <option value="option3">سعر المنتج</option>
                    <option value="option4">الكمية اكثر من</option>
                </select>
                <input type="number" name="id" id="id" placeholder="ادخل الـ id الخاص بالمنتج" style="display: none;">
                <input type="text" name="name" id="name" placeholder="ادخل اسم المنتج" style="display: none;">
                <input type="number" name="price" id="price" placeholder="ادخل سعر المنتج" style="display: none;">
                <input type="number" name="amount" id="amount" placeholder="ادخل الكمية" style="display: none;">
                <button type="submit">بحث</button>
            </div>
        </form>
        
        @if(auth()->user()->role == 'المالك' || auth()->user()->role == 'محاسب')
        <div class="search-container">
            <a href="{{route('products.create')}}" class="add-product-btn">اضافة منتج للمخزن</a>
        </div>
        @endif
        
        <br>
        
        <div class="container">
            @foreach($products as $product)
            <div class="card">
                <img src="{{asset('images/'.$product->image_path)}}" width="200" height="200">
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="{{route('products.show' , $product->id)}}">{{$product->name}}</a>
                    </h3>
                    <p class="card-text">id => {{$product->id}}</p>
                    @if($product->amount == 0)
                    <p class="card-text">الكمية : تم البيع بالكامل</p>
                    @else
                    <p class="card-text">الكمية : {{$product->amount}}</p>
                    @endif
                    <div class="price">السعر : {{$product->price}}</div>
                    @if(auth()->user()->role == 'المالك' || auth()->user()->role == 'محاسب')
                    <form action="{{route('products.destroy' , $product->id)}}" method="post">
                        @csrf
                        @method('Delete')
                        <a href="{{route('products.edit' , $product->id)}}" class="button1">تعديل</a>
                        <input type="submit" class="red-submit" value="حذف">
                    </form>
                    @endif
                    @if($product->amount != 0)
                    <a href="{{route('Bill.create' , $product->id)}}" class="btn">اضافة الي الفاتورة</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        

    
    <script>
        function toggleTextInput(selectElement) {
            var idInput = document.getElementById("id");
            var nameInput = document.getElementById("name");
            var priceInput = document.getElementById("price");
            var amountInput = document.getElementById("amount");

            // Hide all input fields
            idInput.style.display = "none";
            nameInput.style.display = "none";
            priceInput.style.display = "none";
            amountInput.style.display = "none";

            // Show the selected input field based on the selected option
            switch (selectElement.value) {
                case "option1":
                     idInput.style.display = "inline-block";
                    break;
                case "option2":
                     nameInput.style.display = "inline-block";
                    break;
                case "option3":
                     priceInput.style.display = "inline-block";
                    break;
                case "option4":
                     amountInput.style.display = "inline-block";
                    break;
                default:
                    break;
            }
        }
    </script>
</x-app-layout>