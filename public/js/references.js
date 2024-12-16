$(document).ready(function () {
  // Evento que ocurre cuando es cambiado el usuario
  //y se rellena el correo electronico en el campo

  function vaciar_Inputs_Add() {
    $("#name_reference").val("");
    $("#weights_pounds").val("");
    $("#description").val("");
    $("#volume").val("");
    $("#brand").val("");
    $("#notes").val("");
    $("#id_asociar").val("");
    $('#id_auto input[type="radio"]').removeAttr("checked");
    document.getElementById("div_id_mostrar").style.display = "none";
  }
  function vaciar_Inputs_Edit() {
    $("#edit_name_reference").val("");
    $("#edit_weights_pounds").val("");
    $("#edit_volume").val("");
    $("#edit_description").val("");
    $("#edit_brand").val("");
    $("#edit_notes").val("");
  }

  //metodo para ingresar registro
  $("#form_referencias").submit(function (event) {
    if ($("#name_reference").val() === "") {
      alert("Debe ingresar el nombre de referencia", "Atencion!");
      $("#name_reference").focus();
      return false;
    }
    if ($("#weights_pounds").val() === "") {
      alert("Debe ingresar el peso en libras", "Atencion!");
      $("#weights_pounds").focus();
      return false;
    }
    
    if ($("#description").val() === "") {
      alert("Debe ingresar la descripción", "Atencion!");
      $("#description").focus();
      return false;
    }
    if ($("#brand").val() === "") {
      alert("Debe ingresar la marca", "Atencion!");
      $("#brand").focus();
      return false;
    }
    if ($("input[type=radio]:checked").length == 0) {
      alert("Indique al menos una opcion de id");
      return false;
    }

    let confirmacion = confirm("¿Esta seguro de agregar esta información?");
    if (confirmacion) {
      var data = $("#form_referencias").serialize();
      $.ajax({
        url: $("#form_referencias #_url").val(),
        headers: { "X-CSRF-TOKEN": $("#form_referencias #_token").val() },
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
          var json = $.parseJSON(response);
          if (json.success) {
            $("#exampleModal").modal("hide");
            vaciar_Inputs_Add();
            $("#references_table").DataTable().ajax.reload();
            alert("Referencia creado exitosamente");
          } else {
            alert(json.data);
          }
        },
      });
    }
    return false;
  });

  $("#form_edit_referencias").submit(function (event) {
    if ($("#edit_name_reference").val() === "") {
      alert("Debe ingresar el nombre de referencia", "Atencion!");
      $("#edit_name_reference").focus();
      return false;
    }
    if ($("#edit_weights_pounds").val() === "") {
      alert("Debe ingresar el peso en libras", "Atencion!");
      $("#edit_weights_pounds").focus();
      return false;
    }
    if ($("#edit_description").val() === "") {
      alert("Debe ingresar la descripción", "Atencion!");
      $("#edit_description").focus();
      return false;
    }
    if ($("#edit_brand").val() === "") {
      alert("Debe ingresar la marca", "Atencion!");
      $("#edit_brand").focus();
      return false;
    }

    let confirmacion = confirm("¿Esta seguro de editar esta información?");
    if (confirmacion) {
      let ID = document.getElementById("_edit_id").value;
      var data = $("#form_edit_referencias").serialize();
      $.ajax({
        url: $("#form_edit_referencias #_url").val() + "/" + ID,
        headers: { "X-CSRF-TOKEN": $("#form_edit_referencias #_token").val() },
        type: "PUT",
        cache: false,
        data: data,
        success: function (response) {
          var json = $.parseJSON(response);
          if (json.success) {
            $("#EditReference").modal("hide");
            vaciar_Inputs_Edit();
            $("#references_table").DataTable().ajax.reload();
            alert("Referencia editada exitosamente");
          } else {
            alert(json.data);
          }
        },
      });
    }

    return false;
  });

  $("#form_assign_referencias").submit(function (event) {
    if ($("#assign_id_reference").val() === "") {
      alert(
        "Debe ingresar el id que desea al que desea que sea asociado",
        "Atencion!"
      );
      $("#assign_id_reference").focus();
      return false;
    }

    let confirmacion = confirm("¿Esta seguro de asignar a este id?");
    if (confirmacion) {
      let ID = document.getElementById("_assign_id").value;
      let new_reference_id = document.getElementById(
        "assign_id_reference"
      ).value;
      var data = [ID, new_reference_id];
      $.ajax({
        url: $("#form_assign_referencias #_url").val() + "/assign/" + data,
        headers: {
          "X-CSRF-TOKEN": $("#form_assign_referencias #_token").val(),
        },
        type: "GET",
        cache: false,
        data: data,
        success: function (response) {
          var json = $.parseJSON(response);
          if (json.success) {
            $("#AssignReference").modal("hide");
            $("#assign_id_reference").val("");
            $("#references_table").DataTable().ajax.reload();
            alert("Referencia Asignada exitosamente");
          } else {
            alert(json.data);
          }
        },
      });
    }

    return false;
  });
});
