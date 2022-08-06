$(document).ready(function() {
    
    
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
    $('.marcoAlquiler').submit(function(event) {
        var filtro = '';
        var hayErrores =false;
        var divFechas =$(this).parent().parent();
        var divSuperior =$(this).parent().find('.divBtAlquiler');
        var errores = '';
        var fInicio = $(divFechas).find('.inputInicio').val().split("-");
        var f1 = new Date(fInicio[0],fInicio[1],fInicio[2]);
        var fFinal = $(divFechas).find('.inputFin').val().split("-");
        var f2 = new Date(fFinal[0],fFinal[1],fFinal[2]);
        var regFechas = /^([0-2][0-9]|3[0-1])(\/)(0[1-9]|1[0-2])\2(\d{4})$/;

        if($(divFechas).find('.inputInicio').val()==""){
            errores += "<span>*No deje campos vacios</span>";
            hayErrores =true;
        }
        else if($(divFechas).find('.inputFin').val()==""){
            errores += "<span>*No deje campos vacios</span>";
            hayErrores =true;
        }
        else if(!regFechas.test($(divFechas).find('.inputInicio').val())){
            errores += "<span>*Introduzca unas fechas correctas</span>";
            hayErrores =true;
        }
        else if(!regFechas.test($(divFechas).find('.inputFin').val())){
            errores += "<span>*Introduzca unas fechas correctas</span>";
            hayErrores =true;
        }
        else if(f1>=f2){
            errores += "<span>*Fecha inicio menor igual que fecha final</span>";
            hayErrores =true;
        }

        if( hayErrores ) {
            event.preventDefault();
        }
        else{
            //Hago esto porque no tengo donde mandar el formulario y si no da error
            
            var divFechas =$(this).parent().parent();
            
            var mensaje = "Ha alquilado \"";
            var articulo = $(this).parent().find(".nombre").text();

            var fechaDeInicio = $(this).find(".inputInicio").val();
            var fechaDeFinal = $(this).find(".inputFin").val();

            mensaje+=articulo;
            mensaje+="\" del ";
            mensaje+=fechaDeInicio;
            mensaje+=" a ";
            mensaje+=fechaDeFinal;


            
            window.alert(mensaje);
            event.preventDefault();
            window.location.href = '../php/alquiler.php'
           
            
        }

        $(divSuperior).find('.errores').html(errores);
    });
    
    $('.btAlquiler').click(function(){
        
        var nombre = $(this).parent().parent().parent().parent().find(".nombre").text();
        var divFechas =$(this).parent().parent();
        var fInicio = $(divFechas).find('.inputInicio').val();
        var fFinal = $(divFechas).find('.inputFin').val();
        var pedido
        var precioTotal;
        window.open("http://localhost/practica%204/app/public/index.php/createAlquiler?nombre="+nombre+"&fInicio="+fInicio+"&fFin="+fFinal, "_self");

       //window.location.href = "http://localhost/practica%204/app/public/index.php/createAlquiler?nombre="+nombre+"&fInicio="+fInicio+"&fFin="+fFin;
    });

    
    $('.btEliminacion').click(function(){
        var divFechas =$(this).parent().parent();
        var nombre = $(this).parent().parent().parent().parent().find(".nombre").text();
        window.location.href = "http://localhost/practica%204/app/public/index.php/eliminarStock?nombre="+nombre+"&pagina=alquiler", "_self";
        
    });
    $('.btModificacion').click(function(){
        
        var nombre = $(this).parent().parent().parent().parent().find(".nombre").text();
        //var cantidad = $(this).find("#cantidadArticulos").value;
        var cantidad = $(this).parent().find(".cantidadArticulos").val(); 
        window.location.href = "http://localhost/practica%204/app/public/index.php/modificarStock?nombre="+nombre+"&cantidad="+cantidad+"&pagina=alquiler", "_self";
    });
});
