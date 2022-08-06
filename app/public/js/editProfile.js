$(document).ready(function() {
    
    $('#formDatos').submit(function(event) {
        
        
       
        
        error = false;
        var errorEmail = '';
        var errorPassword = '';
        var errorNombre = '';
        var errorApellido = '';
        var errorDNI = '';
        exprEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        exprPassword = /^[a-zA-Z0-9]{4,}$/;
        exprNombre = /^[a-zA-Z]{2,}$/;
        exprApellido = /^[a-zA-Z]{2,}$/;
        exprDNI = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/;

        if($(this).find('#nombre').val()==""){
            errorNombre += "<span>*No deje el campo vacio</span>";
            error = true;
        }
        else if(!exprNombre.test($(this).find('#nombre').val())){
            errorNombre += "<span>*Introduzca un nombre correcto</span>";
            error = true;
        }


        if($(this).find('#apellido').val()==""){
            errorApellido += "<span>*No deje el campo vacio</span>";
            error = true;
        }
        else if(!exprApellido.test($(this).find('#apellido').val())){
            errorApellido += "<span>*Introduzca un apellido correcto</span>";
            error = true;
        }

        if($(this).find('#email').val()==""){
            errorEmail += "<span>*No deje el campo vacio</span>";
            error = true;
        }
        else if(!exprEmail.test($(this).find('#email').val())){
            errorEmail += "<span>*Introduzca un email correcto</span>";
            error = true;
        }

        if($(this).find('#DNI').val()==""){
            errorDNI += "<span>*No deje el campo vacio</span>";
            error = true;
        }
        else if(!exprDNI.test($(this).find('#DNI').val())){
            errorDNI += "<span>*Introduzca un DNI correcto</span>";
            error = true;
        }

       if(($(this).find('#password').val()!="") && (!exprPassword.test($(this).find('#password').val()))){
            errorPassword += "<span>*Introduzca 4 o mas letras o numeros</span>";
            error = true;
        }
        
        $('#errorNombre').html(errorNombre);
        $('#errorEmail').html(errorEmail);
        $('#errorPassword').html(errorPassword);
        $('#errorDNI').html(errorDNI);
        $('#errorApellido').html(errorApellido);
        
       if(error){
           event.preventDefault();
          
       }
       

        
       
        
    }); 
      
    $('#logIn').click(function(event) {
       event.preventDefault(); 
      window.location.href = '../php/inicioSesion.php';
        
    });

});
