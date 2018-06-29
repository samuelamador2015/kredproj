<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('title') | {{ config('app.name') }}</title> 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    </head>
    <body>
    @include('navbar')
    @yield('content')
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <script>
     $(document).ready(function(){
        $('#activities').click(function(e){
           e.preventDefault(); 
           $.ajax({
              url: "{{ route('post_item') }}",
              method: 'POST',
              data: {
                '_token' : $('input[name="_token"]').val(),
                'test'   : 'test'
              },
              success: function(result){
                 console.log(result);
              }});
           });
        });
    </script>
    </body>
</html>
