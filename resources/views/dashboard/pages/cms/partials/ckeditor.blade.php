@include('ckfinder::setup')
<script>
    var ckeditorClassic = document.querySelector('#ckeditor-classic');
    CKEDITOR.replace( 'ckeditor-classic' ,{
        {{--filebrowserBrowseUrl: '/browser/browse.php',--}}
        {{--filebrowserUploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',--}}
        filebrowserBrowseUrl : '{{ route("ckfinder_browser") }}',
        filebrowserUploadUrl : '{{ route("ckfinder_connector") }}'
    });
</script>