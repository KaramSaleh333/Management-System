<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <style>
        /* ===== Google Font Import - Poppins ===== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            transition: all 0.4s ease;
        }

        /* ===== Colours ===== */
        :root {
            --body-color: #E4E9F7;
            --nav-color: #4070F4;
            --side-nav: #010718;
            --text-color: #FFF;
            --search-bar: #F2F2F2;
            --search-text: #010718;
        }

        body {
            height: 100vh;
            background-color: var(--body-color);
        }

        body.dark {
            --body-color: #18191A;
            --nav-color: #242526;
            --side-nav: #242526;
            --text-color: #CCC;
            --search-bar: #242526;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            height: 70px;
            width: 100%;
            background-color: var(--nav-color);
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        body.dark nav {
            border: 1px solid #393838;
        }

        nav .logo {
            font-size: 25px;
            font-weight: 500;
            color: var(--text-color);
            text-decoration: none;
        }

        nav .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links li {
            margin: 0 15px;
            list-style: none;
        }

        .nav-links li a {
            font-size: 17px;
            font-weight: 400;
            color: var(--text-color);
            text-decoration: none;
            padding: 10px;
        }

        .nav-links li a:hover {
            position: relative;
            color: #fff;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto; /* Pushes the user info to the right */
        }

        .user-info .user-name {
            color: var(--text-color);
            margin-right: 10px;
        }

        .user-info .dropdown-trigger {
            display: flex;
            align-items: center;
            color: var(--text-color);
            cursor: pointer;
        }

        .dropdown-menu {
            position: absolute;
            top: 50px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            background-color: #fff;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>

</head>
<body>
    <nav>

        <ul class="nav-links">
            @if(auth()->user()->role == 'المالك')
            <li><a href="{{route('transaction.index')}}">تعديلات الموظفين علي السيستم</a></li>
            @endif
            <li><a href="{{route('Bill.index')}}">الفواتير</a></li>
            <li><a href="{{route('products.index')}}">المخزن</a></li>
            @if(auth()->user()->role == 'المالك' || auth()->user()->role == 'محاسب' )
            <li><a href="{{route('employee.index')}}">ادارة الموظفين</a></li>
            @endif
        </ul>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('الحساب الشخصي') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('تسجيل الخروج') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

    </nav>
</body>
</html>
