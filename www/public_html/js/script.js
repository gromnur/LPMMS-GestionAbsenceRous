
var test ="test";

$("#dept").click(function(){
    $.ajax({

       url : 'test.php', // La ressource ciblée
       timeout:4000,
       type:'GET',
       dataType:'html',
       data:'test=' + test,
       
       success: function(data_html, statut){
           alert("ca marche coooon");
       },
       
       error: function(){
           alert("ouin ouin :(");
       }
    });  
});