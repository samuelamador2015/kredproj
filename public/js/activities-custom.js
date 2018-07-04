 $(document).ready(function(){
    $('button#activities').click(function(e){  
      var $mbody =  $('#activityModal .modal-body');
      $mbody.html('Loading...');
      $.ajax({
        url: "/activities/item",
        method: 'POST',
        data: {
          '_token' : $('input[name="_token"]').val(),
          'id'   :  $(this).data('id')
        },
        success: function(result){   
          var file_caption = (result.file_path != '') ? "<a  class='btn btn-success' href='/activities/download?token=" + result.token +"'>" + 
                   " <i class='fa fa-download'></i>&nbsp;Download <i class='glyphicon glyphicon-download-alt'></i></a>" : "[No File Attached]";
          var table  = "<table class='table'>"; 
          table += "<tr><td class='active' width='150px'>Activity ID </td>" + 
                   "<td>" + result.act_id + "</td></tr>";
          table += "<tr><td class='active'>Student Name </td>" + 
                   "<td>" + result.stud_name + "</td></tr>"; 
          table += "<tr><td class='active'>Activity Title </td>" + 
                   "<td>" + result.act_name + "</td></tr>";   
          table += "<tr><td class='active'>Date Created </td>" + 
                   "<td>" + result.created + "</td></tr>";  
          table += "<tr><td class='active'>Tags </td>" + 
                   "<td>" + result.tags + "</td></tr>";  
          if( result.photo_path != ''){
           table += "<tr><td class='active'>Activity Photo </td>" + 
                   "<td><img src='" + result.photo_path + "' width='50px' /></td></tr>";  
          }
          table += "<tr><td class='active'>Download File </td>" + 
                   "<td>" + file_caption + "</td></tr>"; 
          
          table += "<tr><td class='active'>Details </td>" + 
                   "<td>" + result.details + "</td></tr>"; 
          table += "</table>";

          $mbody.html(table);
        }
      });
    }); 
 
    $('#studentModal .btn-go').click(function(){
      var input = $('#student-search').val(); 
      var tbody = $('#studentModal table tbody');

      tbody.html('<tr><td colspan="4" align="center">Retrieving data....</td></tr>');

      $.ajax({
        url: "/activities/ajax-search",
        method: 'POST',
        data: {
          '_token' : $('input[name="_token"]').val(),
          'input'  : input
        },
        success: function(result){    
          var mytr = '';
          for(var x=0; x < result.length; x++){
            mytr += '<tr>'
            mytr += '<td>' + result[x].id + '</td>';
            mytr += '<td>' + result[x].name + '</td>';
            mytr += '<td>' + result[x].email + '</td>';
            mytr += '<td><button data-id="' + result[x].id  +
                    '" data-studname="'+ result[x].name + 
                    '" class="btn btn-xs btn-primary selectStudent">Select</button></td>'
            mytr += '</tr>';
          }
          tbody.html(mytr);
        }
      });
    });

    $('.btndelete').click(function(){
      if( confirm('You are going to delete this activity. You can no longer undo this action. Are you sure?')){
        return true;
      }
      return false;
    });
});

/* We need to call this event before or after AJAX call
 * Walley kaayu. :D
*/
 $(document).on("click", ".selectStudent", function(){

    var studid   = $(this).data('id'); 
    var studname = $(this).data('studname'); 
 
    $('#studname').val(studname);
    $('#studid').val(studid);
    $('#studentModal').modal('toggle');
    return false;
 });