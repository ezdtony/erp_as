
$(document).ready(function() {
    $('#btnenviar').click(function(){

        var datos=$('#formcontac').serialize();
        
        /* alert(datos);
        return false; */

        $.ajax({
            type: "POST",
            url: "php/models/regist.php", /* "php/controllers/userController.php", */
            data: datos,
            success: function (r) {
                if(r==1){
                    alert("agregado con exito");
                }else{
                    alert("fallo al server");
                }
                
            }
        });
       return false;        
    });
    
});

