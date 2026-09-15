var alertList = document.querySelectorAll('.alert')
alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
})

//Validar Login
function login(obj) {
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe ingresar su nombre de usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return false;
    }
    if (username.length < 3){
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "¡Parece que faltan algunos dígitos en el usuario que ingresaste!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return (false);
    }
    var contraseña = obj.contraseña.value;
    if (!contraseña) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe  ingresar su contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.contraseña.focus();
        return false;
    }
    if (contraseña.length < 4){
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "¡Parece que faltan algunos dígitos en la contraseña que ingresaste!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.contraseña.focus();
		return (false);
	}

}

//Validar Login boton del correo
function Email(obj) {
    var email_login= obj.email_login.value;
    if (!email_login) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe ingresar su correo",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email_login.focus();
        return false;
    }

    if (email_login.trim() == "") {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "El campo de gmail no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email_login.focus();
        return false;
    }

    if (/^([a-zA-Z0-9])\1+$/.test(email_login)) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "El campo de gmail no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email_login.focus();
        return false;
    }

}

//Validar Registro de USUARIO
function registrousuario(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un nombre",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }
    if (name.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return (false);
    }
    if (name.trim() == "") {
        Swal.fire({
           title: 'Registro de Usuario',
           text: "El campo de nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.name.focus();
       return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(name)) {
         Swal.fire({
            title: 'Registro de Usuario',
            text: "El campo de nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(name)) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }
    var nameA = obj.nameA.value;
    if (!nameA) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un apellido",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nameA.focus();
        return false;
    }
    if (nameA.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nameA.focus();
        return (false);
    }
    if (nameA.trim() == "") {
        Swal.fire({
           title: 'Registro de Usuario',
           text: "El campo de nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.nameA.focus();
       return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(nameA)) {
         Swal.fire({
            title: 'Registro de Usuario',
            text: "El campo de nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nameA.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(nameA)) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nameA.focus();
        return false;
    }
    var email = obj.email.value;
    if (!email) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un e-mail",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email.focus();
        return false;
    }
    if (email.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email.focus();
        return (false);
    }
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un nombre de usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return false;
    }
    if (username.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return (false);
    }
    // var rol = obj.rol.value;
    // if (rol==0){
    //     alert("Debe de seleccionar el Rol del Usuario");
    //     return (false);
    // }
    var password = obj.password.value;
    if (!password) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.password.focus();
        return false;
    }
    if (password.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texo o numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.password.focus();
		return (false);
	}
    var password_confirmation = obj.password_confirmation.value;
    if (!password_confirmation) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar la confirmación de la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.password_confirmation.focus();
        return false;
    }
    if (password_confirmation.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto o numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.password_confirmation.focus();
		return (false);
	}
    if (password_confirmation != password) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Las contraseñas no coinciden",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.password_confirmation.focus();
        return false;
    }

}

//Validar Roles
function roles(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Rol',
            text: "Debe de ingresar el nombre del rol.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }
    if (name.length < 2){
		Swal.fire({
            title: 'Rol',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.name.focus();
		return (false);
	}
    if (name.trim() == "") {
        Swal.fire({
            title: 'Rol',
            text: "El campo de rol no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }

    if (/(\w)\1+/i.test(name.toLowerCase())) {
    Swal.fire({
            title: 'Rol',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nombre.focus();
        return false;
    }

}

//Validar Usuario
function usuario(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el nombre del usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }
    if (name.length < 3){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.name.focus();
		return (false);
	}
    if (name.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de nombre del usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.name.focus();
        return false;
    }

    if (/(\w)\1+/i.test(name.toLowerCase())) {
    Swal.fire({
            title: 'Usuario',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nombre.focus();
        return false;
    }

    var email = obj.email.value;
    if (!email) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el e-mail",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email.focus();
        return false;
    }
    if (email.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.email.focus();
		return (false);
	}
    if (email.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de e-mail no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(email)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de e-mail no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.version.focus();
        return false;
    }
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return false;
    }
    if (username.length < 2){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.username.focus();
		return (false);
	}
    if (username.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(username)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de usuario no debe contener solo caracteres repetidos",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.username.focus();
        return false;
    }
    var password = obj.password.value;
    if (!password) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar la contraseña.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.password.focus();
        return false;
    }
    if (password.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.password.focus();
		return (false);
	}
    if (password.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de Contraseña no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.password.focus();
        return false;
    }
    // if (/^([a-zA-Z0-9])\1+$/.test(password)) {
    //     alert("El Campo Contraseña no debe contener solo Caracteres Repetidos.");
    //     obj.version.focus();
    //     return false;
    // }
    var confirm_password = obj.confirm_password.value;
    if (!confirm_password) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar la confirmación de la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.confirm_password.focus();
        return false;
    }
    if (confirm_password.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

		obj.confirm_password.focus();
		return (false);
	}
    if (confirm_password != password) {
        Swal.fire({
            title: 'Usuario',
            text: "Las contraseñas no coinciden",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.confirm_password.focus();
        return false;
    }
}

//VALIDAR OFICINA
function Oficina(obj) {
    var encargadoCedula = obj.encargado_cedula.value.trim();
    var nombreEncargado = obj.nombre_encargado.value.trim();
    var nombreOficina = obj.nombre_oficina.value.trim();
    var nombrePattern = /^[\p{Lu}][\p{Ll} ]*$/u;

    function mostrarError(campo, mensaje) {
        Swal.fire({
            title: 'Oficina',
            text: mensaje,
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        campo.focus();
    }

    if (!/^\d{7,8}$/.test(encargadoCedula)) {
        mostrarError(obj.encargado_cedula, 'La cédula debe contener únicamente entre 7 y 8 dígitos.');
        return false;
    }

    if (!nombrePattern.test(nombreEncargado) || nombreEncargado.length > 30) {
        mostrarError(obj.nombre_encargado, 'El nombre del encargado debe comenzar con una sola mayúscula y continuar en minúsculas.');
        return false;
    }

    if (!nombrePattern.test(nombreOficina) || nombreOficina.length > 30) {
        mostrarError(obj.nombre_oficina, 'El nombre de la oficina debe comenzar con una sola mayúscula y continuar en minúsculas.');
        return false;
    }

    obj.encargado_cedula.value = encargadoCedula;
    obj.nombre_encargado.value = nombreEncargado;
    obj.nombre_oficina.value = nombreOficina;
    return true;
}


//VALIDAR PERSONA
function validarPersona(obj) {
    var cedula = obj.cedula.value.trim();
    var nombre = obj.nombre.value.trim();
    var apellido = obj.apellido.value.trim();
    var email = obj.email.value.trim();
    var telefono = obj.telefono.value.trim();
    var nombrePattern = /^[\p{Lu}][\p{Ll} ]*$/u;

    function mostrarError(campo, mensaje) {
        Swal.fire({
            title: 'Persona',
            text: mensaje,
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        campo.focus();
    }

    if (!/^\d{7,8}$/.test(cedula)) {
        mostrarError(obj.cedula, 'La cédula debe contener únicamente entre 7 y 8 dígitos.');
        return false;
    }

    if (!nombrePattern.test(nombre) || nombre.length > 30) {
        mostrarError(obj.nombre, 'El nombre debe comenzar con una mayúscula y continuar en minúsculas.');
        return false;
    }

    if (!nombrePattern.test(apellido) || apellido.length > 30) {
        mostrarError(obj.apellido, 'El apellido debe comenzar con una mayúscula y continuar en minúsculas.');
        return false;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) || email.length > 50) {
        mostrarError(obj.email, 'Ingrese un correo electrónico válido.');
        return false;
    }

    if (!/^\d{7,11}$/.test(telefono)) {
        mostrarError(obj.telefono, 'El teléfono debe contener únicamente entre 7 y 11 dígitos.');
        return false;
    }

    if (!obj.id_oficina.value) {
        mostrarError(obj.id_oficina, 'Debe seleccionar una oficina.');
        return false;
    }

    obj.cedula.value = cedula;
    obj.nombre.value = nombre;
    obj.apellido.value = apellido;
    obj.email.value = email;
    obj.telefono.value = telefono;
    return true;
}

function Personas(obj) {
    return validarPersona(obj);
}

function Persona(obj) {
    return validarPersona(obj);
}

//VALIDAR MARCA Y MODELO
function validarNombreCatalogo(obj, campo, titulo) {
    var input = obj[campo];
    var valor = input.value.trim();

    if (!valor || valor.length > 50 || !/^[\p{L}\p{N}][\p{L}\p{N} .'-]*$/u.test(valor)) {
        Swal.fire({
            title: titulo,
            text: 'Ingrese un nombre válido',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        input.focus();
        return false;
    }

    input.value = valor;
    return true;
}

function Marca(obj) {
    return validarNombreCatalogo(obj, 'nombre_marca', 'Marca');
}

function Modelo(obj) {
    return validarNombreCatalogo(obj, 'nombre_modelo', 'Modelo');
}

//VALIDAR TIPO DE PERIFERICO
function TipoPeriferico(obj) {
    var input = obj.tipo;
    var valor = input.value.trim();

    if (!valor || valor.length > 50 || !/^[\p{L}\p{N}][\p{L}\p{N} .'-]*$/u.test(valor)) {
        Swal.fire({
            title: 'Tipo de periférico',
            text: 'Ingrese un nombre del tipo de periférico.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        input.focus();
        return false;
    }

    input.value = valor;
    return true;
}

//VALIDAR PERIFERICO
function Periferico(obj) {
    var campos = [
        { input: obj.id_tipo, mensaje: 'Debe seleccionar un tipo de periférico.' },
        { input: obj.id_marca, mensaje: 'Debe seleccionar una marca.' },
        { input: obj.id_modelo, mensaje: 'Debe seleccionar un modelo.' }
    ];

    for (var i = 0; i < campos.length; i++) {
        if (!campos[i].input.value) {
            Swal.fire({
                title: 'Periférico',
                text: campos[i].mensaje,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
            campos[i].input.focus();
            return false;
        }
    }

    var serial = obj.serial.value.trim();

    if (!serial || serial.length > 50 || !/^[\p{L}\p{N}][\p{L}\p{N} .\/_-]*$/u.test(serial)) {
        Swal.fire({
            title: 'Periférico',
            text: 'Ingrese un serial válido.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        obj.serial.focus();
        return false;
    }

    obj.serial.value = serial;
    return true;
}

//VALIDAR ARTICULO
function mostrarErrorArticulo(input, mensaje) {
    Swal.fire({
        title: 'Artículo',
        text: mensaje,
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
    input.focus();
    return false;
}

function validarCampoArticulo(input, mensaje, maximo, patron) {
    var valor = input.value.trim();

    if (!valor || valor.length > maximo || (patron && !patron.test(valor))) {
        return mostrarErrorArticulo(input, mensaje);
    }

    input.value = valor;
    return true;
}

function articulo(obj) {
    var tipo = obj.querySelector('input[type="hidden"][name="tipo_biene"]');
    var tipoMobiliario = obj.elements.namedItem('tipo_mobiliario');
    var altura = obj.elements.namedItem('altura');
    var anchura = obj.elements.namedItem('anchura');
    var serial = obj.elements.namedItem('serial');
    var descripcion = obj.elements.namedItem('descripcion_mobiliario');

    tipo.value = 'Mobiliario';

    if (!validarCampoArticulo(tipoMobiliario, 'Ingrese el tipo de mobiliario.', 15, /^[\p{L}\p{N}][\p{L}\p{N} .-]*$/u)) {
        return false;
    }
    if (!validarCampoArticulo(altura, 'Ingrese la altura del mobiliario.', 50, /^[\p{L}\p{N} .,/()-]+$/u)) {
        return false;
    }
    if (!validarCampoArticulo(anchura, 'Ingrese la anchura del mobiliario.', 50, /^[\p{L}\p{N} .,/()-]+$/u)) {
        return false;
    }
    if (!validarCampoArticulo(serial, 'Ingrese un serial de mobiliario válido.', 50, /^[\p{L}\p{N}][\p{L}\p{N} .\/_-]*$/u)) {
        return false;
    }
    return validarCampoArticulo(descripcion, 'Ingrese la descripción del mobiliario.', 1000);
}

function articulo_equipo(obj) {
    var tipo = obj.querySelector('input[type="hidden"][name="tipo_biene"]');
    var codigo = obj.elements.namedItem('codigo_equipo');
    var cpu = obj.elements.namedItem('cpu');
    var ram = obj.elements.namedItem('ram');
    var disco = obj.elements.namedItem('disco_duro');
    var sistema = obj.elements.namedItem('sistema_operativo');
    var serial = obj.elements.namedItem('serial');
    var periferico = obj.elements.namedItem('id_periferico');
    var descripcion = obj.elements.namedItem('descripcion_equipo');

    tipo.value = 'Equipo';

    if (!validarCampoArticulo(codigo, 'El código del equipo es obligatorio.', 100)) {
        return false;
    }
    if (!validarCampoArticulo(cpu, 'Ingrese el CPU del equipo.', 12)) {
        return false;
    }
    if (!validarCampoArticulo(ram, 'Ingrese la memoria RAM del equipo.', 100)) {
        return false;
    }
    if (!validarCampoArticulo(disco, 'Ingrese la capacidad del disco duro.', 100)) {
        return false;
    }
    if (!validarCampoArticulo(sistema, 'Ingrese el sistema operativo.', 100)) {
        return false;
    }
    if (!validarCampoArticulo(serial, 'Ingrese un serial de equipo válido.', 50, /^[\p{L}\p{N}][\p{L}\p{N} .\/_-]*$/u)) {
        return false;
    }
    if (!periferico.value) {
        return mostrarErrorArticulo(periferico, 'Debe seleccionar un periférico.');
    }
    return validarCampoArticulo(descripcion, 'Ingrese la descripción del equipo.', 1000);
}

// Fin de la validación del Sistema Contraloria //

//Validacion de no permitir numeros en los campos de texto de solo letras

function soloLetras(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
    if (tecla==0){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
patron =/[a-zA-ZÑñáéíóú .*/]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);

}


//Validacion de no permitir letras en los campos de texto de solo numeros
function solonum(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
    if (tecla==0){
    return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9/*.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

/*--------------Validacion de no permitir espacios en los campos de texto de usuario y clave del registro de Usuarios-----------------*/
function sinespacios(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-zA-ZÑñáéíóú0-9/*._@#$%&()-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
