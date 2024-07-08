$(document).ready(function () {
    // Evento que ocurre cuando es cambiado el usuario
    //y se rellena el correo electronico en el campo

    function vaciar_Inputs_Add() {
        $("#fullnameClient").val("");
        $("#typeId").val("");
        $("#identificationClient").val("");
        $("#directionClient").val("");
        $("#phoneClient").val("");
        $("#marginClient").val("");
    }
    function vaciar_Inputs_Edit() {
        $("#edit_fullnameClient").val("");
        $("#edit_typeId").val("");
        $("#edit_identificationClient").val("");
        $("#edit_directionClient").val("");
        $("#edit_phoneClient").val("");
        $("#edit_marginClient").val("");
    }

    //metodo para ingresar registro
    $("#form_clients").submit(function (event) {
        if ($("#fullnameClient").val() == "") {
            alert("Debe ingresar el nombre del cliente", "Atencion!");
            $("#fullnameClient").focus();
            return false;
        }
        if ($("#typeId").val() == "") {
            alert("Debe seleccionar el tipo de identificación", "Atencion!");
            $("#typeId").focus();
            return false;
        }
        if ($("#identificationClient").val() == "") {
            alert("Debe ingresar el numero de identificación", "Atencion!");
            $("#identificationClient").focus();
            return false;
        }
        if ($("#directionClient").val() == "") {
            alert("Debe ingresar la dirección", "Atencion!");
            $("#directionClient").focus();
            return false;
        }
        if ($("#phoneClient").val() == "") {
            alert("Debe ingresar el telefono", "Atencion!");
            $("#phoneClient").focus();
            return false;
        }
        if ($("#marginClient").val() == "") {
            alert("Indique el margen sugerido");
            $("#marginClient").focus();
            return false;
        }
        if ($("#id_user_create").val() == "") {
            alert("No se encuentra el id del usuario");
            $("#id_user_create").focus();
            return false;
        }
        let confirmacion = confirm("¿Esta seguro de agregar esta información?");
        if (confirmacion) {
            var data = $("#form_clients").serialize();
            $.ajax({
                url: $("#form_clients #_url").val(),
                headers: { "X-CSRF-TOKEN": $("#form_clients #_token").val() },
                type: "POST",
                cache: false,
                data: data,
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.success) {
                        $("#addClientsModal").modal("hide");
                        vaciar_Inputs_Add();
                        $("#clients_table").DataTable().ajax.reload();
                        alert("Cliente creado exitosamente");
                    } else {
                        alert(json.data);
                    }
                },
            });
        }
        return false;
    });

    $("#form_edit_clients").submit(function (event) {
        if ($("#edit_fullnameClient").val() == "") {
            alert("Debe ingresar el nombre del cliente", "Atencion!");
            $("#edit_fullnameClient").focus();
            return false;
        }
        if ($("#edit_typeId").val() == "") {
            alert("Debe seleccionar el tipo de identificación", "Atencion!");
            $("#edit_typeId").focus();
            return false;
        }
        if ($("#edit_identificationClient").val() == "") {
            alert("Debe ingresar el numero de identificación", "Atencion!");
            $("#edit_identificationClient").focus();
            return false;
        }
        if ($("#edit_directionClient").val() == "") {
            alert("Debe ingresar la dirección", "Atencion!");
            $("#edit_directionClient").focus();
            return false;
        }
        if ($("#edit_phoneClient").val() == "") {
            alert("Debe ingresar el telefono", "Atencion!");
            $("#edit_phoneClient").focus();
            return false;
        }
        if ($("#edit_marginClient").val() == "") {
            alert("Indique el margen sugerido");
            $("#edit_marginClient").focus();
            return false;
        }
        if ($("#id_user_edit").val() == "") {
            alert("No se encuentra el id del usuario");
            $("#id_user_edit").focus();
            return false;
        }
        let confirmacion = confirm("¿Esta seguro de editar esta información?");
        if (confirmacion) {
            let ID = document.getElementById("_edit_id").value;
            var data = $("#form_edit_clients").serialize();
            $.ajax({
                url: $("#form_clients #_url").val() + "/" + ID,
                headers: {
                    "X-CSRF-TOKEN": $("#form_clients #_token").val(),
                },
                type: "PUT",
                cache: false,
                data: data,
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.success) {
                        $("#EditClients").modal("hide");
                        vaciar_Inputs_Edit();
                        $("#clients_table").DataTable().ajax.reload();
                        alert("Cliente editado exitosamente");
                    } else {
                        alert(json.data);
                    }
                },
            });
        }

        return false;
    });
});
