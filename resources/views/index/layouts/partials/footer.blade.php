<footer class="custom-footer position-relative d-flex align-items-center">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="copy-rights mb-0">
                    {{ core()->getSetting('site_title') }} | Copyright © <script> document.write(new Date().getFullYear()) </script>
                </p>
            </div>
            <div>
                Hỗ trợ: {{ core()->getSetting('hotline') }}
            </div>
        </div>
    </div>
</footer>
<button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>