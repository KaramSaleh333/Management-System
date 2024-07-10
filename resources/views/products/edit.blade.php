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
        position: absolute;
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

<title>تعديل منتج</title>
<x-app-layout>
    <br><br>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>تعديل منتج</header>
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="field input-field">
                        <label for="name">الاسم :</label>
                        <input type="text" id="name" placeholder="اسم المنتج" value="{{ $product->name }}" maxlength="100" name="name" class="input" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="field input-field">
                        <label for="price">سعر المنتج :</label>
                        <input type="number" id="price" placeholder="سعر المنتج" value="{{ $product->price }}" min="1" name="price" class="password" required>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="field input-field">
                        <label for="amount">الكمية المتوفرة من المنتج :</label>
                        <input type="number" id="amount" placeholder="الكمية المتوفرة من المنتج" value="{{ $product->amount }}" min="1" name="amount" class="password" required>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="field input-field">
                        <label for="image">صورة المنتج :</label>
                        <input type="file" id="image" name="image" class="password">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="field button-field">
                        <button>تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
