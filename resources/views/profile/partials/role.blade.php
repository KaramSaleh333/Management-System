<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('الوظيفة') }}
        </h2>
        <br>
    </header>
        <div>
            <input type="text" value="{{auth()->user()->role}}" disabled>
        </div>
</section>
