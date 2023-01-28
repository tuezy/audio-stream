@foreach([
'assets/css/bootstrap.min.css',
'assets/css/icons.min.css',
'assets/css/app.min.css',
'assets/css/custom.min.css'
] as $style)
    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
@endforeach
