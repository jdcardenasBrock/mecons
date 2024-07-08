$(document).ready(function () {
    // Evento que ocurre cuando es cambiado el usuario
    //y se rellena el correo electronico en el campo

    function vaciar_Inputs_Add() {
        $("#fullnameProvider").val("");
        $("#countryProvider").val("");
        $("#directionProvider").val("");
        $("#mailProvider").val("");
        $("#phoneProvider").val("");
        $("#pageWebProvider").val("");
    }
    function vaciar_Inputs_Edit() {
        $("#edit_fullnameProvider").val("");
        $("#edit_countryProvider").val("");
        $("#edit_directionProvider").val("");
        $("#edit_mailProvider").val("");
        $("#edit_phoneProvider").val("");
        $("#edit_pageWebProvider").val("");
    }

    //metodo para ingresar registro
    $("#form_providers").submit(function (event) {
        if ($("#fullnameProvider").val() == "") {
            alert("Debe ingresar el nombre del cliente", "Atencion!");
            $("#fullnameProvider").focus();
            return false;
        }
        if ($("#countryProvider").val() == "") {
            alert("Debe seleccionar el pais", "Atencion!");
            $("#countryProvider").focus();
            return false;
        }
        if ($("#directionProvider").val() == "") {
            alert("Debe ingresar la direccion", "Atencion!");
            $("#directionProvider").focus();
            return false;
        }
        if ($("#mailProvider").val() == "") {
            alert("Debe ingresar el correo electronico", "Atencion!");
            $("#mailProvider").focus();
            return false;
        }
        if ($("#phoneProvider").val() == "") {
            alert("Debe ingresar el telefono", "Atencion!");
            $("#phoneProvider").focus();
            return false;
        }
        if ($("#pageWebProvider").val() == "") {
            alert("Debe ingresar la pagina web");
            $("#pageWebProvider").focus();
            return false;
        }
        if ($("#id_user_create").val() == "") {
            alert("No se encuentra el id del usuario");
            $("#id_user_create").focus();
            return false;
        }
        let confirmacion = confirm("¿Esta seguro de agregar esta información?");
        if (confirmacion) {
            var data = $("#form_providers").serialize();
            $.ajax({
                url: $("#form_providers #_url").val(),
                headers: { "X-CSRF-TOKEN": $("#form_providers #_token").val() },
                type: "POST",
                cache: false,
                data: data,
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.success) {
                        $("#addProvidersModal").modal("hide");
                        vaciar_Inputs_Add();
                        $("#providers_table").DataTable().ajax.reload();
                        alert("Proveedor creado exitosamente");
                    } else {
                        alert(json.data);
                    }
                },
            });
        }
        return false;
    });

    $("#form_edit_providers").submit(function (event) {
        if ($("#edit_fullnameProvider").val() == "") {
            alert("Debe ingresar el nombre del proveedor", "Atencion!");
            $("#edit_fullnameProvider").focus();
            return false;
        }
        if ($("#edit_countryProvider").val() == "") {
            alert("Debe seleccionar el pais", "Atencion!");
            $("#edit_countryProvider").focus();
            return false;
        }
        if ($("#edit_directionProvider").val() == "") {
            alert("Debe ingresar la dirección", "Atencion!");
            $("#edit_directionProvider").focus();
            return false;
        }
        if ($("#edit_mailProvider").val() == "") {
            alert("Debe ingresar el correo electronico", "Atencion!");
            $("#edit_mailProvider").focus();
            return false;
        }
        if ($("#edit_phoneProvider").val() == "") {
            alert("Debe ingresar el telefono del proveedor", "Atencion!");
            $("#edit_phoneProvider").focus();
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
            var data = $("#form_edit_providers").serialize();
            $.ajax({
                url: $("#form_providers #_url").val() + "/" + ID,
                headers: {
                    "X-CSRF-TOKEN": $("#form_providers #_token").val(),
                },
                type: "PUT",
                cache: false,
                data: data,
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.success) {
                        $("#EditProviders").modal("hide");
                        vaciar_Inputs_Edit();
                        $("#providers_table").DataTable().ajax.reload();
                        alert("Proveedor editado exitosamente");
                    } else {
                        alert(json.data);
                    }
                },
            });
        }

        return false;
    });
});
