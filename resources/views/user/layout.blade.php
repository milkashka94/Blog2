<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
</head>
<body>
@include('user.includes.navigation')
@yield('content')
</body>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#description').summernote({
            height:300
        })
        $('#text').summernote({
            height:300
        })
    })

    $(document).ready(function () {
        bsCustomFileInput.init()
    })
</script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
</html>
