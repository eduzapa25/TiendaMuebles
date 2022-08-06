$(document).ready(function() {
    var filtro = '';
    
    
    $('.selector').change(function() {
        filtro='';
        $('.articulo').hide();
        // Filtros
        if( ( $('#tipo').val()==4)||($('#madera').val()==5)||($('#color').val()==5)){
            filtro+=".articulo"
        }
        //Mesas
        if( $('#tipo').val()==1 ) {
            filtro+=".mesa"
        }
        //Sillas
        if( $('#tipo').val()==2 ) {
            filtro+=".silla"
        } 
        //Armarios
        if( $('#tipo').val()==3){
            filtro+=".armario"
        }
        if( $('#madera').val()==1){
            filtro+=".roble"
        }
        if( $('#madera').val()==2){
            filtro+=".ebano"
        }
        if( $('#madera').val()==3){
            filtro+=".pino"
        }
        if( $('#madera').val()==4){
            filtro+=".nogal"
        }
        if( $('#color').val()==1){
            filtro+=".blanco"
        }
        if( $('#color').val()==2){
            filtro+=".claro"
        }
        if( $('#color').val()==3){
            filtro+=".oscuro"
        }
        if( $('#color').val()==4){
            filtro+=".negro"
        }
        $(filtro).show();
    });

    $('.btCompra').click(function(){
        var nombre = $(this).parent().parent().find(".nombre").text();   
        window.open("http://localhost/practica%204/app/public/index.php/createCompra?nombre="+nombre, "_self");

    });

    $('.btEliminacion').click(function(){
        
        var nombre = $(this).parent().parent().parent().find(".nombre").text();
       
        
        window.location.href = "http://localhost/practica%204/app/public/index.php/eliminarStock?nombre="+nombre+"&pagina=compra";
        
    });
    $('.btModificacion').click(function(){
        
        var nombre = $(this).parent().parent().parent().find(".nombre").text();
        //var cantidad = $(this).find("#cantidadArticulos").value;
        var cantidad = $(this).parent().find(".cantidadArticulos").val(); 
        window.location.href = "http://localhost/practica%204/app/public/index.php/modificarStock?nombre="+nombre+"&cantidad="+cantidad+"&pagina=compra";
        
    });
    
    
    
});
