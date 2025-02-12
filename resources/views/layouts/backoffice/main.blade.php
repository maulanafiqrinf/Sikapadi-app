@include('layouts.backoffice.partials.app')

<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.backoffice.partials.sidebar')
            <div class="layout-page">
                @include('layouts.backoffice.partials.navbar')
                <div class="content-wrapper">
                    @yield('content')
                    @include('layouts.backoffice.partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.backoffice.partials.script')
</body>
</html>
