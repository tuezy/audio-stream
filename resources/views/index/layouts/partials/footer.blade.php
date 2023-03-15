<footer class="custom-footer position-relative d-flex align-items-center" style="height: 100px">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="copy-rights mb-0" style="font-size: 14px">
                    <p>Mã số thuế: 03055633881</p>
                    <p>Địa chỉ: {{ core()->getSetting('address') }}</p>
                    <p>© Bản quyền thuộc về Hoàng Thế Long</p>
                </div>
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