<footer class="custom-footer position-relative d-flex align-items-center">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">

                <div class="copy-rights mb-0">
                <div>
                    <img src="{{ asset("images/play-final.png") }}" alt="logo">
                </div>
                <p>Mã số thuế: 03055633881</p>
                <p>Địa chỉ: {{ core()->getSetting('address') }}</p>
                <p>© Bản quyền thuộc về Hoàng Thế Long</p>
{{--                    {{ core()->getSetting('site_title') }} | Copyright © <script> document.write(new Date().getFullYear()) </script>--}}
                </p>
            <div>
                Hỗ trợ: {{ core()->getSetting('hotline') }}
            </div>
        </div>
    </div>
</footer>
<button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>