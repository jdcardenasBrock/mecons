

$(document).ready(function(){
    // Evento que ocurre cuando es cambiado el usuario
    //y se rellena el correo electronico en el campo
    
 function vaciar_Inputs_Add(){
    $('#name').val("");
    $('#email').val("");
    $('#password').val("");
 }
    //metodo para ingresar registro
    $('#form_add_users').submit(function(event){
        if ($('#name').val() === "") {
            alert('Debe ingresar el nombre completo','Atencion!');
            $('#name').focus();
            return false;
        }
        if ($('#email').val() === "") {
          alert('Debe ingresar el correo','Atencion!');
          $('#email').focus();
          return false;
        }
        if ($('#password').val() === "") {
          alert('Debe ingresar la contraseña','Atencion!');
          $('#password').focus();
          return false;
        }
       
      

        let confirmacion=confirm("¿Esta seguro de agregar esta información?");
          if(confirmacion){

            var data = $('#form_add_users').serialize();
            console.log(data);
            $.ajax({
              url: $('#form_add_users #_url').val(),
              headers: {'X-CSRF-TOKEN': $('#form_add_users #_token').val()},
              type: 'POST',
              cache: false,
              data: data,
              success: function (response) {
                var json = $.parseJSON(response);
                if(json.success){
                $("#addUser").modal('hide');
                vaciar_Inputs_Add();
                $('#users_table').DataTable().ajax.reload();
                 alert('Usuario creado exitosamente');
                  
                }else{
                  alert(json.data);
                }
              }
           });
          }
          
         return false;

    });
    function Empty_Inputs_Edit(){
      $("#edit_name_permission").val("");
      $('#edit_email').val() === "";
      $('#edit_password').val() === "";
    }
    $('#form_edit_users').submit(function(event){
        if ($('#edit_name').val() === "") {
            alert('Debe ingresar el nombre del usuario','Atencion!');
            $('#edit_name').focus();
            return false;
        }
      
        if ($('#edit_email').val() === "") {
          alert('Debe ingresar el email','Atencion!');
          $('#edit_email').focus();
          return false;
        }
        if ($('#edit_password').val() === "") {
          alert('Debe ingresar la contraseña','Atencion!');
          $('#edit_password').focus();
          return false;
        }

        let confirmacion=confirm("¿Esta seguro de editar esta información?");
          if(confirmacion){
            let ID= document.getElementById("_edit_id").value;
            var data = $('#form_edit_users').serialize();
            $.ajax({
              url: $('#form_edit_users #_url').val()+"/"+ID,
              headers: {'X-CSRF-TOKEN': $('#form_edit_users #_token').val()},
              type: 'PUT',
              cache: false,
              data: data,
              success: function (response) {
                var json = $.parseJSON(response);
                if(json.success){
                $("#EditUser").modal('hide');
                Empty_Inputs_Edit();
                $('#users_table').DataTable().ajax.reload();
                 alert('Usuario editado exitosamente');
                  
                }else{
                  alert(json.data);
                }
              }
           });
          }
          
         return false;

    });


    
});