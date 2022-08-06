$(document).ready(function() {
    $('.botonEliminar').click(function() {
        
       
       
       
        var id = $(this).parent().parent().find(".id").text();
        var tipo = $(this).parent().parent().attr('class');
      
       
        if(tipo == "trAlquiler"){
            window.open('http://localhost/practica%204/app/public/index.php/deleteAlquiler?uid='+id,"_self");
        }else if(tipo == "trCompra"){
            window.open('http://localhost/practica%204/app/public/index.php/deleteCompra?uid='+id,"_self");

        }else if(tipo == "trReparacion"){
            window.open('http://localhost/practica%204/app/public/index.php/deleteReparacion?uid='+id,"_self");

        }
    });
});
