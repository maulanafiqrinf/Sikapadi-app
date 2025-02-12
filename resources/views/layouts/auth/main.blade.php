@include('layouts.auth.partials.app')
<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            @yield('content')
        </div>
    </div>
    @include('layouts.auth.partials.script')
</body>
