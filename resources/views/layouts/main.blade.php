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
        $('button#activities').click(function(e){  
          var $mbody =  $('#activityModal .modal-body');
          $mbody.html('Loading...');
          $.ajax({
              url: "{{ route('post_item') }}",
              method: 'POST',
              data: {
                '_token' : $('input[name="_token"]').val(),
                'id'   :  $(this).data('id')
              },
              success: function(result){     
                var result = JSON.parse( result );
                var table  = "<table class='table'>"; 
                table += "<tr><td class='active' width='150px'>Activity ID </td>" + 
                         "<td>" + result[0].act_id + "</td></tr>";
                table += "<tr><td class='active'>Student Name </td>" + 
                         "<td>" + result[0].stud_name + "</td></tr>"; 
                table += "<tr><td class='active'>Activity Title </td>" + 
                         "<td>" + result[0].act_name + "</td></tr>";   
                table += "<tr><td class='active'>Date Created </td>" + 
                         "<td>" + result[0].created + "</td></tr>";  
                table += "<tr><td class='active'>Link </td>" + 
                         "<td>" + result[0].link + "</td></tr>"; 
                table += "<tr><td class='active'>Download File </td>" + 
                         "<td>" + result[0].file_path + "</td></tr>"; 
                table += "<tr><td class='active'>Details </td>" + 
                         "<td>" + result[0].details + "</td></tr>"; 
                table += "</table>";

                $mbody.html(table);
              }});
           }); 

          $('.selectStudent').click(function(){
              var studid   = $(this).data('id'); 
              var studname = $(this).data('studname'); 

              $('#studname').val(studname);
              $('#studid').val(studid);
              $('#studentModal').modal('toggle');
              return false;
          });
      });
    </script>
    </body>
</html> 