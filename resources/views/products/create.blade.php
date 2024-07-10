<style>
    /* Google Fonts - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #4070f4;
        column-gap: 30px;
    }

    .form {
        max-width: 430px;
        width: 100%;
        padding: 30px;
        border-radius: 6px;
        background: #FFF;
    }

    header {
        font-size: 28px;
        font-weight: 600;
        color: #232836;
        text-align: center;
        margin-bottom: 20px; /* Improve spacing between header and form */
    }

    form {
        margin-top: 30px;
    }

    .field {
        position: relative;
        margin-top: 20px;
        /* Adjust spacing between fields */
    }

    .field input,
    .field button {
        height: 50px;
        width: 100%;
        font-size: 16px;
        font-weight: 400;
        border-radius: 6px;
        border: 1px solid #cacaca;
        padding: 0 15px;
        outline: none;
    }

    .field input:focus {
        border-bottom-width: 2px;
    }

    .field button {
        color: #fff;
        background-color: #0171d3;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .field button:hover {
        background-color: #016dcb;
    }

    .form-link {
        text-align: center;
        margin-top: 10px;
    }

    .form-link span,
    .form-link a {
        font-size: 14px;
        font-weight: 400;
        color: #232836;
    }

    .form a {
        color: #0171d3;
        text-decoration: none;
    }

    .form-content a:hover {
        text-decoration: underline;
    }

    .media-options a {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media screen and (max-width: 400px) {
        .form {
            padding: 20px 10px;
        }
    }
</style>

<title>تسجيل منتج</title>
<x-app-layout>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>تسجيل منتج</header>
                    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                       @csrf

                        <div class="field input-field">
                            <input type="text" placeholder="اسم المنتج" name="name" maxlength="100" class="input" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="field input-field">
                            <input type="number" placeholder="سعر المنتج" name="price" min="1" class="password" required>
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="field input-field">
                            <input type="number" placeholder="الكمية المتوفره من المنتج" min="1" name="amount" class="password" required>
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div class="field input-field">
                            <label for="im">صورة المنتج :</label>
                            <input type="file" id="im" name="image" class="password" required>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        
                        <div class="field button-field">
                            <button>تسجيل الدخول</button>
                        </div>
                    </form>

        </section>
</x-app-layout>