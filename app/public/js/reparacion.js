$(document).ready(function() {
    $('.btReparacion').click(function() {
        var hayErrores = false;
        var error='';
        if($('#tipo').val()=="0"){
            hayErrores = true;
            error+="<span>*No dejes campos vacios</span>";
        }
        
        if(hayErrores){
           
            $('#errores').html(error);
        }
        else{
            //Pongo el event prevent defaul porque todavia no tengo donde enviar el formulario
            var reparacion = $("#tipo option:selected").text();
            var articulo = $(this).parent().parent().find(".nombre").text();
           
            
            window.open("http://localhost/practica%204/app/public/index.php/createReparacion?nombre="+articulo+"&tipo="+reparacion, "_self");
            
         }
 


        
        
    });
    $('.btEliminacion').click(function(){
        
        var nombre = $(this).parent().parent().parent().find(".nombre").text();
       
        window.location.href = "http://localhost/practica%204/app/public/index.php/eliminarStock?nombre="+nombre+"&pagina=reparacion", "_self";
        
    });
    $('.btModificacion').click(function(){
        
        var nombre = $(this).parent().parent().parent().find(".nombre").text();
        //var cantidad = $(this).find("#cantidadArticulos").value;
        var cantidad = $(this).parent().find(".cantidadArticulos").val(); 
        window.location.href = "http://localhost/practica%204/app/public/index.php/modificarStock?nombre="+nombre+"&cantidad="+cantidad+"&pagina=reparacion", "_self";
    });

});
