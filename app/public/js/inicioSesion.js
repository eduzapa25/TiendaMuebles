$(document).ready(function() {
    
    $('form').submit(function(event) {
        error = false;
        var errorEmail = '';
        var errorPassword = '';
        exprEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        exprPassword = /^[a-zA-Z0-9]{4,}/;
        if($(this).find('#email').val()==""){
            errorEmail += "<span>*No deje el campo vacio</span>";
            error = true;
        }
        else if(!exprEmail.test($(this).find('#email').val())){
            errorEmail += "<span>*Introduzca un email correcto</span>";
            error = true;
        }
        
        if($(this).find('#password').val()==""){
            errorPassword += "<span>*No deje el campo vacio</span>";
            error = true;
            
        }
        else if(!exprPassword.test($(this).find('#password').val())){
            errorPassword += "<span>*Introduzca 4 o mas numeros o letras</span>";
            error = true;
        }

        $('#errorEmail').html(errorEmail);
        $('#errorPassword').html(errorPassword);
        
       if(error){
           event.preventDefault();
          
       }
       
        
    });   
    $('#registro').click(function() {
        
        window.open("http://localhost/practica%204/app/public/index.php/registro", "_self");
        
    });

});
