var counter=1;
function start()
{
    alert("ciao");
    // $.post( "../student.php").done(function( data ) {
    // alert( "Data Loaded: " + data );
//   });
// var jqxhr = $.post( "../student.php", function() {
//     alert( "success" );
//   })
//     .done(function() {
//       alert( "second success" );
//     })
//     .fail(function() {
//       alert( "error" );
//     })
//     .always(function() {
//       alert( "finished" );
//     });
    $.ajax({
        url: '../student.php',
      type: 'get',
    	contentType: 'application/json',
      success: function(data, textstatus, jQxhr){
            alert("success");
            alert(data);
                /* Tutto OK*/
       },
       error: function (data, textstatus, errorThrown){
        console.log (errorThrown);
    }
  });
}
$(document).ready(function() {
	start();
});