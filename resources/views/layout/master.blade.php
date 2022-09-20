<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('Title')
    
    <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css') }}">
    @yield('Style')
</head>
<body>


    @yield('Content')



    <script src="{{ url('jquery.min.js') }}"></script>
    <script src="{{url('bootstrap/js/bootstrap.min.js') }}"></script>
    @yield('Script')

</body>
</html>