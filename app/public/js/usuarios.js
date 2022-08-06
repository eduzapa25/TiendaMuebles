$(document).ready(function() {
    $('.botonModificar').click(function() {
        
       
        
        
        var dni = $(this).parent().parent().find(".tdDNI").text();
        
        
        
        window.open('../php/editProfileAdmin.php?uid='+dni,"_self");

        
    });
    $('.botonEliminar').click(function() {
        
       
       
        
        var dni = $(this).parent().parent().find(".tdDNI").text();
        
        
        
        window.open('../php/usersController.php?uid='+dni+'&action=deleteAdmin',"_self");

        
    });
    if($('.botonEliminar').parent().parent().find(".tdRol").text() =="cliente"){
        //window.open('../php/landPage.php',"_self");
        $('.botonEliminar').hide();
        $('.botonEliminar').parent().parent().find(".botonModificar").hide();
    }


});
