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

//VALIDAR CARGO
function Cargo(obj) {


// Obtén el campo de la cargo para aplicar la validación en tiempo real.
var nombre_cargoInput = obj.nombre_cargo ;

// Agrega un evento de teclado que se activa cada vez que se presiona una tecla.
nombre_cargoInput.onkeydown = function(e) {
    // Definimos una expresión regular que coincide con cualquier caracter que no sea una letra, un número o un espacio.
    // Esto es una forma más amplia de bloquear caracteres especiales que solo . * /
    var regex = /[^a-zA-Z0-9\s]/; 

    // Obtiene el caracter de la tecla presionada.
    // var caracterPresionado = String.fromCharCode(e.keyCode);

    // Si el caracter de la tecla coincide con nuestra expresión regular, lo bloqueamos.
    if (regex.test(caracterPresionado)) {
        // Muestra una alerta para informar al usuario.
        Swal.fire({
            title: 'Cargo',
            text: 'El nombre de la cargo no puede contener caracteres especiales.',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // Evita que el caracter se escriba en el campo.
        return false;
    }
};

// --- Tu validación para el envío del formulario, ahora con todas las validaciones ---

var nombre_cargo  = obj.nombre_cargo .value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (nombre_cargo .trim() === "") {
    Swal.fire({
        title: 'Cargo',
        text: "Debe de ingresar el nombre de la Cargo, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.nombre_cargo .focus();
    return false;
}
// 2. Validar que no contenga los caracteres especiales (esta es una segunda capa de seguridad).
else if (/[^a-zA-Z0-9\s]/.test(nombre_cargo )) {
    Swal.fire({
        title: 'Error de formato',
        text: "El nombre de la cargo no puede contener caracteres especiales.",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.nombre_cargo .focus();
    return false;
}
     var categoria = obj.categoria.value;
   if (!categoria) {
       Swal.fire({
           title: 'Cargo',
           text: "Seleccione el cargo.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.categoria.focus();
       return false;
    }

}
//VALIDAR VOCEROS
function  Voceros(obj) {
    var cedula = obj.cedula.value;

// Expresión regular para detectar los caracteres especiales
var caracteresEspeciales = /[.*\/]/;

if (!cedula) {
    Swal.fire({
        title: 'Voceros',
        text: "Debe de ingresar la cédula.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.cedula.focus();
    return false;
} else if (caracteresEspeciales.test(cedula)) {
    // Si la cédula contiene alguno de los caracteres especiales
    Swal.fire({
        title: 'Error de formato',
        text: "El campo de la cédula no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.cedula.focus();
    return false;
}

// Si la validación pasa, el código continuará su ejecución
   if (cedula.length < 7 || cedula.length > 8){
    Swal.fire({
        title: 'Voceros',
        text: "La cédula no puede tener más de 8 dígitos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.cedula.focus();
    return (false);
    }


  // Obtén el campo de nombre para aplicar la validación en tiempo real
var nombreInput = obj.nombre;

// Agrega un evento de teclado para bloquear caracteres no deseados mientras se escriben
nombreInput.onkeydown = function(e) {
    // Definimos los códigos de teclado para los caracteres especiales que queremos bloquear
    // Código del punto '.' es 190
    // Código del asterisco '*' es 56 (cuando se usa la tecla Shift)
    // Código del slash '/' es 191
    var caracteresProhibidos = [190, 191, 56]; 

    // Si el código de la tecla presionada está en nuestra lista de prohibidos...
    if (caracteresProhibidos.includes(e.keyCode)) {
        // Muestra una alerta para informar al usuario
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'El campo del nombre no puede contener puntos (.), asteriscos (*) o barras diagonales (/).',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // ¡Importante! Devuelve `false` para evitar que el carácter se escriba en el campo
        return false;
    }
};

// --- Tu validación para el envío del formulario ---

var nombre = obj.nombre.value;

// 1. Validar que el campo no esté vacío
if (!nombre) {
    Swal.fire({
        title: 'Voceros',
        text: "Debe de ingresar un nombre.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.nombre.focus();
    return false;
} 
// 2. Validar que el campo no contenga los caracteres especiales
else if (/[.*\/]/.test(nombre)) {
    Swal.fire({
        title: 'Error en el Nombre',
        text: "El nombre del vocero no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.nombre.focus();
    return false;
}
var nombre = obj.nombre.value;
   if (nombre.length < 3){
       Swal.fire({
           title: 'Voceros',
           text: "Faltan dígitos en este campo de nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return (false);
   }
 var nombre = obj.nombre.value;
   if (nombre.trim() == "") {
       Swal.fire({
           title: 'Voceros',
           text: "El Campo del nombre no debe contener espacios en blancos.",
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

var apellido= obj.apellido;

// Agregamos un evento de teclado para bloquear caracteres no deseados mientras se escriben
apellido.onkeydown = function(e) {
    // Definimos los códigos de teclado para los caracteres especiales que queremos bloquear
    // Código del punto '.' es 190
    // Código del asterisco '*' es 56 (cuando se usa la tecla Shift)
    // Código del slash '/' es 191
    var caracteresProhibidos = [190, 191, 56]; 

    // Si el código de la tecla presionada está en nuestra lista de prohibidos...
    if (caracteresProhibidos.includes(e.keyCode)) {
        // Muestra una alerta para informar al usuario
        Swal.fire({
            title: 'Error en el apellido',
            text: 'El campo del apellido de vocero no puede contener puntos (.), asteriscos (*) o barras diagonales (/).',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // ¡Importante! Devuelve `false` para evitar que el carácter se escriba en el campo
        return false;
    }
};
 var apellido = obj.apellido.value;
if (!apellido) {
    Swal.fire({
        title: 'Voceros',
        text: "Debe de ingresar el apellido.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.apellido.focus();
    return false;
} 
// 2. Validar que no contenga los caracteres especiales
else if (/[.*\/]/.test(apellido)) {
    Swal.fire({
        title: 'Error de formato',
        text: "El apellido no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.apellido.focus();
    return false;
}
// 3. Validar la longitud
else if (apellido.length < 4){
    Swal.fire({
        title: 'Voceros',
        text: "Faltan dígitos en este campo de apellido.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.apellido.focus();
    return false;
} 
// 4. Validar que no contenga solo espacios en blanco
else if (apellido.trim() === "") {
    Swal.fire({
        title: 'Voceros',
        text: "El campo de apellido no debe contener espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.apellido.focus();
    return false;
}
var fecha_nacimiento = obj.fecha_nacimiento.value;
   if (!fecha_nacimiento) {
       Swal.fire({
           title: 'Voceros',
           text: "Debe de ingresar fecha de nacimientos .",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.fecha_nacimiento.focus();
       return false;
   }
var fecha_nacimiento = obj.fecha_nacimiento.value;

// Validar que es mayor de edad
const hoy = new Date();
const fechaNac = new Date(fecha_nacimiento);
let edad = hoy.getFullYear() - fechaNac.getFullYear();
const mes = hoy.getMonth() - fechaNac.getMonth();

// Ajustar edad si aún no ha pasado el mes o día de nacimiento este año
if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
    edad--;
}

if (edad < 18) {
    Swal.fire({
        title: 'Voceros',
        text: "Debe ser mayor de 18 años para registrarse.",
        icon: 'error',
        confirmButtonColor: '#3085d6',
    });
    obj.fecha_nacimiento.focus();
    return false;
}



    var genero = obj.genero.value;
   if (!genero) {
       Swal.fire({
           title: 'Voceros',
           text: "Seleccione el género.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.genero.focus();
       return false;
    }

 // Obtenemos el campo de teléfono para aplicar la validación en tiempo real
var telefonoInput = obj.telefono;

// Agregamos un evento de teclado para bloquear caracteres no deseados mientras se escriben
telefonoInput.onkeydown = function(e) {
    // Definimos los códigos de teclado para los caracteres especiales que queremos bloquear
    // Código del punto '.' es 190
    // Código del asterisco '*' es 56 (cuando se usa la tecla Shift)
    // Código del slash '/' es 191
    var caracteresProhibidos = [190, 191, 56]; 

    // Si el código de la tecla presionada está en nuestra lista de prohibidos...
    if (caracteresProhibidos.includes(e.keyCode)) {
        // Muestra una alerta para informar al usuario
        Swal.fire({
            title: 'Error en teléfono',
            text: 'El campo del teléfono no puede contener puntos (.), asteriscos (*) o barras diagonales (/).',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // ¡Importante! Devuelve `false` para evitar que el carácter se escriba en el campo
        return false;
    }
};

// --- Tu validación para el envío del formulario, ahora con la nueva validación ---

var telefono = obj.telefono.value;

// 1. Validar que el campo no esté vacío
if (!telefono) {
    Swal.fire({
        title: 'Voceros',
        text: "Debe de ingresar el Teléfono.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.telefono.focus();
    return false;
} 
// 2. Validar que no contenga los caracteres especiales
else if (/[.*\/]/.test(telefono)) {
    Swal.fire({
        title: 'Error de formato',
        text: "El teléfono no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.telefono.focus();
    return false;
}

    var correo = obj.correo.value;
   if (!correo) {
       Swal.fire({
           title: 'Voceros',
           text: "Ingrese el correo.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
    })
     obj.correo.focus();
        return false;
    }

      var id_cargo = obj.id_cargo.value;
   if (!id_cargo) {
       Swal.fire({
           title: 'Cargo',
           text: "Seleccione el Tipo de cargo.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.id_cargo.focus();
       return false;
    }

      var tipo_vocero = obj.tipo_vocero.value;
   if (!tipo_vocero) {
       Swal.fire({
           title: 'Cargo',
           text: "Seleccione el Tipo de vocero.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.tipo_vocero.focus();
       return false;
    }

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Voceros',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (direccion.trim() == "") {
        Swal.fire({
            title: 'Voceros',
            text: "El campo de dirección no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    Swal.fire({
            title: 'Voceros',
            text: "El campo de dirección no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.direccion.focus();
        return false;
    }

    if (direccion.length < 5){
        Swal.fire({
            title: 'Voceros',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }



}

//VALIDAR COMUNIDAD
function Comunidad(obj) {


// Obtén el campo de la comunidad para aplicar la validación en tiempo real.
var nom_comuniInput = obj.nom_comuni;

// Agrega un evento de teclado que se activa cada vez que se presiona una tecla.
nom_comuniInput.onkeydown = function(e) {
    // Definimos una expresión regular que coincide con cualquier caracter que no sea una letra, un número o un espacio.
    // Esto es una forma más amplia de bloquear caracteres especiales que solo . * /
    var regex = /[^a-zA-Z0-9\s]/; 

    // Obtiene el caracter de la tecla presionada.
    // var caracterPresionado = String.fromCharCode(e.keyCode);

    // Si el caracter de la tecla coincide con nuestra expresión regular, lo bloqueamos.
    if (regex.test(caracterPresionado)) {
        // Muestra una alerta para informar al usuario.
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'El nombre de la comunidad no puede contener caracteres especiales.',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // Evita que el caracter se escriba en el campo.
        return false;
    }
};

// --- Tu validación para el envío del formulario, ahora con todas las validaciones ---

var nom_comuni = obj.nom_comuni.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (nom_comuni.trim() === "") {
    Swal.fire({
        title: 'Comunidad',
        text: "Debe de ingresar el nombre de la Comunidad, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.nom_comuni.focus();
    return false;
}
// 2. Validar que no contenga los caracteres especiales (esta es una segunda capa de seguridad).
else if (/[^a-zA-Z0-9\s]/.test(nom_comuni)) {
    Swal.fire({
        title: 'Error de formato',
        text: "El nombre de la comunidad no puede contener caracteres especiales.",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.nom_comuni.focus();
    return false;
}

   

    // Obtén el campo de la dirección para aplicar la validación en tiempo real.
var direccionInput = obj.direccion;

// Agrega un evento de teclado que se activa cada vez que se presiona una tecla.
direccionInput.onkeydown = function(e) {
    // Definimos los códigos de teclado para las teclas que queremos permitir siempre.
    // Esto incluye teclas de control y navegación.
    // 8: Backspace, 46: Delete, 37: Flecha izquierda, 39: Flecha derecha
    var teclasPermitidas = [8, 46, 37, 39];

    // Verifica si la tecla presionada es una de las teclas permitidas para el borrado o navegación.
    if (teclasPermitidas.includes(e.keyCode)) {
        return; // Permite la acción predeterminada de la tecla (borrar, mover el cursor, etc.).
    }

    // Definimos una expresión regular que coincide con cualquier carácter que no sea una letra, un número, un espacio, una coma, un punto o un guion.
    var regex = /[^a-zA-Z0-9\s-]/;

    // Obtiene el carácter de la tecla presionada.
    // var caracterPresionado = String.fromCharCode(e.keyCode);

    // Si el carácter de la tecla coincide con nuestra expresión regular, lo bloqueamos.
    if (regex.test(caracterPresionado)) {
        // Muestra una alerta para informar al usuario.
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'El campo de la dirección solo permite letras, números, espacios, comas, puntos y guiones.',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // Evita que el carácter se escriba en el campo.
        return false;
    }
};

// --- Tu validación para el envío del formulario, ahora con la validación de caracteres especiales ---

var direccion = obj.direccion.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (direccion.trim() === "") {
    Swal.fire({
        title: 'Comunidad',
        text: "Debe ingresar la dirección. No puede estar vacía o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.direccion.focus();
    return false;
}
// 2. Validar que no contenga los caracteres especiales (esta es una segunda capa de seguridad).
else if (/[^a-zA-Z0-9\s-,]/.test(direccion)) {
    Swal.fire({
        title: 'Comunidad',
        text: "La dirección no puede contener caracteres especiales. Solo se permiten letras, números, comas, puntos,espacios, guiones.",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.direccion.focus();
    return false;
}
var direccion = obj.direccion.value;
    if (direccion.length < 5){
        Swal.fire({
            title: 'Comunidad',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }

     var tipo_comunidad = obj.tipo_comunidad.value;
   if (!tipo_comunidad) {
       Swal.fire({
           title: 'Comunidad',
           text: "Seleccione el Tipo de comunidad.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.tipo_comunidad.focus();
       return false;
    }

    var tipo_vivienda = obj.tipo_vivienda.value;
   if (!tipo_vivienda) {
       Swal.fire({
           title: 'Comunidad',
           text: "Seleccione el Tipo de vivienda que esta la comunidad.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.tipo_vivienda.focus();
       return false;
    }

    var lindero_norte = obj.lindero_norte.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (lindero_norte.trim() === "") {
    Swal.fire({
        title: 'Comunidad',
        text: "Ingrese el lindero norte, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.lindero_norte.focus();
    return false;
}

   var lindero_sur = obj.lindero_sur.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (lindero_sur.trim() === "") {
    Swal.fire({
        title: 'Comunidad',
        text: "Ingrese el lindero sur, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.lindero_sur.focus();
    return false;
}

  var lindero_este = obj.lindero_este.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (lindero_este.trim() === "") {
    Swal.fire({
        title: 'Comunidad',
        text: "Ingrese el lindero este, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.lindero_este.focus();
    return false;
}

var lindero_oeste = obj.lindero_oeste.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (lindero_oeste.trim() === "") {
    Swal.fire({
        title: 'Comunidad',
        text: "Ingrese el lindero oeste, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.lindero_oeste.focus();
    return false;
}
}

//VALIDAR CONSEJO COMUNAL
function  ConsejoComunal(obj) {
    var id_vocero = obj.id_vocero.value;
    if (!id_vocero){
        Swal.fire({
            title: 'Consejo comunal',
            text: "Debe de seleccionar un vocero asignado",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_vocero.focus();
        return (false);
    }
   var nom_consej = obj.nom_consej.value;
   if (!nom_consej) {
       Swal.fire({
           title: 'Consejo comunal',
           text: "Debe de ingresar el nombre del consejo comunal.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nom_consej.focus();
       return false;
   }

    var situr = obj.situr.value;
   if (!situr) {
       Swal.fire({
           title: 'Consejo comunal',
           text: "Debe de ingresar el codigo situr.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.situr.focus();
       return false;
   }

   var rif = obj.rif.value;
// Expresión regular modificada: 
// ^C       -> Debe empezar con la letra 'C' mayúscula.
// -?       -> Puede tener un guion opcional.
// \d{9,10}$ -> Debe tener entre 9 y 10 dígitos numéricos al final.
var regex = /^C-?\d{9,10}$/;

if (!rif) {
    Swal.fire({
        title: 'Consejo comunal',
        text: "Debe ingresar el RIF.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.rif.focus();
    return false;
} else if (!regex.test(rif)) {
    Swal.fire({
        title: 'Consejo comunal',
        // Mensaje de error más específico
        text: "El RIF debe comenzar **SOLO** con la letra 'C' mayúscula, seguido de 9 o 10 dígitos numéricos (ejemplo: C-123456789).", 
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    });

    obj.rif.focus();
    return false;
}


if (rif.trim() == "") {
    Swal.fire({
        title: 'Consejo comunal',
        text: "El Campo del RIF no debe contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.rif.focus();
    return false;
}

var id_comunidad = obj.id_comunidad.value;
   if (!id_comunidad) {
       Swal.fire({
           title: 'Consejo comunal',
           text: "Seleccione La Comunidad asignada .",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.id_comunidad.focus();
       return false;
    }

    var dire_consejo = obj.dire_consejo.value;
    if (!dire_consejo) {
        Swal.fire({
            title: 'Consejo comunal',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.dire_consejo.focus();
        return false;
    }

    if (dire_consejo.trim() == "") {
        Swal.fire({
            title: 'Consejo comunal',
            text: "El campo de dirección no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.dire_consejo.focus();
        return false;
    }

    if (/(\w)\2+/i.test(dire_consejo.toLowerCase())) {
    Swal.fire({
            title: 'Consejo comunal',
            text: "El campo de dirección no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.dire_consejo.focus();
        return false;
    }

    if (dire_consejo.length < 5){
        Swal.fire({
            title: 'Consejo comunal',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.dire_consejo.focus();
        return (false);
    }

   var id_comunidad = obj.id_comunidad.value;
    if (!id_comunidad){
        Swal.fire({
            title: 'Consejo comunal',
            text: "Debe de seleccionar una comunidad asignado",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_comunidad.focus();
        return (false);
    }

    
}

//VALIDAR COMUNA
function Comuna(obj) {


 var id_vocero = obj.id_vocero.value;
    if (!id_vocero){
        Swal.fire({
            title: 'Comuna',
            text: "Debe de seleccionar un vocero",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_vocero.focus();
        return (false);
    }

// Obtén el campo del nombre de la comuna para aplicar la validación en tiempo real.
var nom_comunasInput = obj.nom_comunas;

// Agrega un evento de teclado que se activa cada vez que se presiona una tecla.
nom_comunasInput.onkeydown = function(e) {
    // Teclas permitidas para el borrado y navegación
    // 8: Backspace, 46: Delete, 37: Flecha izquierda, 39: Flecha derecha
    var teclasPermitidas = [8, 46, 37, 39];

    // Si la tecla presionada es una de las permitidas, salimos de la función para no bloquearla.
    if (teclasPermitidas.includes(e.keyCode)) {
        return;
    }

    // Definimos una expresión regular que coincide con cualquier carácter que no sea una letra, un número o un espacio.
    var regex = /[^a-zA-Z0-9\s]/; 

    // Obtiene el carácter de la tecla presionada.
    //var caracterPresionado = String.fromCharCode(e.keyCode);

    // Si el carácter coincide con nuestra expresión regular, lo bloqueamos.
    if (regex.test(caracterPresionado)) {
        // Muestra una alerta para informar al usuario.
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'El nombre de la comuna no puede contener caracteres especiales.',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // Evita que el carácter se escriba en el campo.
        return false;
    }
};



var nom_comunas = obj.nom_comunas.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (nom_comunas.trim() === "") {
    Swal.fire({
        title: 'Comuna',
        text: "Debe de ingresar el nombre de la comuna, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.nom_comunas.focus();
    return false;
}
// 2. Validar que no contenga los caracteres especiales (segunda capa de seguridad).
else if (/[^a-zA-Z0-9\s]/.test(nom_comunas)) {
    Swal.fire({
        title: 'Error de formato',
        text: "El nombre de la comuna no puede contener caracteres especiales.",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.nom_comunas.focus();
    return false;
}

var rif_comuna = obj.rif_comuna.value;
// Expresión regular modificada: 
// ^C       -> Debe empezar con la letra 'C' mayúscula.
// -?       -> Puede tener un guion opcional.
// \d{9,10}$ -> Debe tener entre 9 y 10 dígitos numéricos al final.
var regex = /^C-?\d{9,10}$/;

if (!rif_comuna) {
    Swal.fire({
        title: 'Comuna',
        text: "Debe ingresar el RIF.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.rif_comuna.focus();
    return false;
} else if (!regex.test(rif_comuna)) {
    Swal.fire({
        title: 'Comuna',
        // Mensaje de error más específico
        text: "El RIF debe comenzar **SOLO** con la letra 'C' mayúscula, seguido de 9 o 10 dígitos numéricos (ejemplo: C-123456789).", 
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    });

    obj.rif_comuna.focus();
    return false;
}


if (rif_comuna.trim() == "") {
    Swal.fire({
        title: 'Comuna',
        text: "El Campo del RIF no debe contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.rif_comuna.focus();
    return false;
}

   var id_parroquia = obj.id_parroquia.value;
    if (!id_parroquia){
        Swal.fire({
            title: 'Comuna',
            text: "Debe de seleccionar una Parroquia",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_parroquia.focus();
        return (false);
    }

     var id_consejo = obj.id_consejo.value;
    if (!id_consejo){
        Swal.fire({
            title: 'Comuna',
            text: "Debe de seleccionar un consejo",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_consejo.focus();
        return (false);
    }

   // Obtén el campo de la dirección para aplicar la validación en tiempo real.
var dire_comunasInput = obj.dire_comunas;

// Agrega un evento de teclado que se activa cada vez que se presiona una tecla.
dire_comunasInput.onkeydown = function(e) {
    // Teclas permitidas para el borrado y navegación
    // 8: Backspace, 46: Delete, 37: Flecha izquierda, 39: Flecha derecha
    var teclasPermitidas = [8, 46, 37, 39];

    // Si la tecla presionada es una de las permitidas, salimos de la función para no bloquearla.
    if (teclasPermitidas.includes(e.keyCode)) {
        return;
    }

    // Definimos una expresión regular que coincide con cualquier carácter que no sea una letra, un número, un espacio o una comilla simple.
    // Esto bloqueará puntos, comas, guiones, comillas dobles, etc.
    var regex = /[^a-zA-Z0-9\s,']/; 

    // Obtiene el carácter de la tecla presionada.
    var caracterPresionado = String.fromCharCode(e.keyCode);

    // Si el carácter coincide con nuestra expresión regular (es un caracter no permitido), lo bloqueamos.
    if (regex.test(caracterPresionado)) {
        // Muestra una alerta para informar al usuario.
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'La dirección solo puede contener letras, números, espacios y comillas simples (\').',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // Evita que el carácter se escriba en el campo.
        return false;
    }
};

// --- Tus validaciones para el envío del formulario, ahora en un orden lógico ---

var dire_comunas = obj.dire_comunas.value;

// 1. Validar que el campo no esté vacío o contenga solo espacios en blanco.
if (dire_comunas.trim() === "") {
    Swal.fire({
        title: 'Comuna',
        text: "Debe ingresar la dirección. No puede estar vacía o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.dire_comunas.focus();
    return false;
}
// 2. Validar que no contenga caracteres especiales (segunda capa de seguridad).
else if (/[^a-zA-Z0-9\s,']/.test(dire_comunas)) {
    Swal.fire({
        title: 'Error de formato',
        text: "La dirección no puede contener caracteres especiales. Solo se permiten letras, números, espacios y comillas simples (\').",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.dire_comunas.focus();
    return false;
}
// 3. Validar que la longitud sea de al menos 5 caracteres.
else if (dire_comunas.length < 5){
    Swal.fire({
        title: 'Comuna',
        text: "Faltan dígitos en este campo de texto.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.dire_comunas.focus();
    return false;
}
// 4. Validar que no contenga caracteres repetidos.
else if (/(\w)\2+/i.test(dire_comunas.toLowerCase())) {
    Swal.fire({
        title: 'Comuna',
        text: "El campo de dirección no debe contener caracteres repetidos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.dire_comunas.focus();
    return false;
 }
}

// Validar Ayuda
function Ayuda (obj) {
    // Dentro de la función de validación del formulario (por ejemplo, en el evento 'submit').
var nombre_ayuda = document.getElementById('nombre_ayuda').value;

// 1. Validar que el campo no esté vacío o solo contenga espacios en blanco.
if (nombre_ayuda.trim() === "") {
    Swal.fire({
        title: 'Nombre de la ayuda',
        text: "Debe ingresar el nombre de la ayuda. No puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    });

    document.getElementById('nombre_ayuda').focus();
    return false; // Evita que el formulario se envíe.
}
// 2. Validar que no contenga caracteres especiales (segunda capa de seguridad).
else if (/[^a-zA-Z0-9\s]/.test(nombre_ayuda)) {
    Swal.fire({
        title: 'Caracter no permitido',
        text: "El nombre de la ayuda no puede contener caracteres especiales.",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    document.getElementById('nombre_ayuda').focus();
    return false; // Evita que el formulario se envíe.
}


var tipo_ayuda = obj.tipo_ayuda.value;
if (!tipo_ayuda) {
    Swal.fire({
        title: 'Tipo de ayuda',
        text: "Debe seleccionar un tipo de ayuda.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
    obj.tipo_ayuda.focus();
    return false;
}
var descripcion = obj.descripcion.value;

// 1. Validate that the field is not empty.
if (!descripcion) {
    Swal.fire({
        title: 'Descripción',
        text: "Debe ingresar la descripción.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion.focus();
    return false;
}

// 2. Validate that the field doesn't contain only whitespace.
if (descripcion.trim() === "") {
    Swal.fire({
        title: 'Descripción',
        text: "El campo de la descripción no debe contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion.focus();
    return false;

  
}

// 3. Validate the minimum length (at least 5 characters).
if (descripcion.length < 5) {
    Swal.fire({
        title: 'Descripción',
        text: "Faltan dígitos en este campo de texto. La descripción debe tener al menos 5 caracteres.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion.focus();
    return false;
}
var foto_ayuda_input = obj.foto_ayuda;
    var archivos = foto_ayuda_input.files;

    // 1. Validar la presencia del archivo
    if (archivos.length === 0) {
        Swal.fire({
            title: 'Comprobante de la Ayuda',
            text: "Debe seleccionar al menos un archivo o una foto de Ayuda.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });
        
        foto_ayuda_input.focus();
        return false;
    }

    // 2. Validar el formato de los archivos seleccionados
    var allowedExtensions = /(\.pdf|\.doc|\.docx|\.jpeg|\.jpg|\.png)$/i;
    
    // Si el input permite múltiples archivos (aunque tu código solo usa .value, lo cual solo funciona bien para inputs de texto o select, 
    // pero si lo defines como <input type="file" multiple>, debes iterar. Para el ejemplo, usaremos el primer archivo si es singular).

    for (var i = 0; i < archivos.length; i++) {
        var fileName = archivos[i].name;

        if (!allowedExtensions.exec(fileName)) {
            Swal.fire({
                title: 'Comprobante de la Ayuda',
                text: "El archivo '" + fileName + "' tiene un formato no válido. Solo se permiten PDF, DOC, DOCX, JPEG, y PNG.",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
            });
            foto_ayuda_input.focus();
            return false;
        }
    }

 }   
// Validar Proyecto
function Proyectos(obj) {

    var id_parroquia = obj.id_parroquia.value;
    if (!id_parroquia){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe de seleccionar una Parroquia",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_parroquia.focus();
        return (false);
    }
    // Definimos una función de utilidad para el evento de teclado,
    // para evitar repetir el mismo código en cada campo.
    function setupOnkeydown(inputElement, fieldName) {
        inputElement.onkeydown = function(e) {
            // Teclas permitidas: Backspace, Delete, Flechas, etc.
            var teclasPermitidas = [8, 46, 37, 39];

            // Si la tecla es una de las permitidas, salimos de la función.
            if (teclasPermitidas.includes(e.keyCode)) {
                return;
            }

            // Expresión regular para bloquear los caracteres especiales: * . /
            var regex = /[.*\/]/;

            // Obtiene el carácter de la tecla presionada (solo para caracteres imprimibles).
            var caracterPresionado = String.fromCharCode(e.keyCode);

            // Si el carácter coincide con nuestra expresión regular, lo bloqueamos.
            if (regex.test(caracterPresionado)) {
                Swal.fire({
                    title: 'Proyecto',
                    text: `El campo de ${fieldName} no puede contener los caracteres especiales: *, . o /.`,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                });
                return false;
            }
        };
    }
var nombre_pro = obj.nombre_pro.value;
    if (nombre_pro.trim() === "") {
    Swal.fire({
        title: 'Proyecto',
        text: "Debe de ingresar el nombre del proyecto, no puede estar vacío o contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.nombre_pro.focus();
    return false;
}
 var descripcion_pro = obj.descripcion_pro.value;
    if (!descripcion_pro) {
    Swal.fire({
        title: 'Proyecto',
        text: "Debe ingresar la descripción.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion_pro.focus();
    return false;
}

var descripcion_pro = obj.descripcion_pro.value;
if (!descripcion_pro.trim() === "") {
    Swal.fire({
        title: 'Proyecto',
        text: "El campo de la descripción no debe contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion_pro.focus();
    return false;
}



 var tipo_pro = obj.tipo_pro.value;
    if (!tipo_pro){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar un tipo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.tipo_pro.focus();
    return false;
        
    }

    var actividades = obj.actividades.value;
    if (!actividades) {
    Swal.fire({
        title: 'Proyecto',
        text: "Debe ingresar la actividad.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.actividades.focus();
    return false;
}

if (!actividades.trim() === "") {
    Swal.fire({
        title: 'Proyecto',
        text: "El campo de la descripción no debe contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.actividades.focus();
    return false;
}

var cantidad_bene = obj.cantidad_bene.value;

    // 1. Validar que no esté vacío (siempre debe poner la cantidad)
    if (!cantidad_bene || cantidad_bene.trim() === "") {
        Swal.fire({
            title: 'Proyecto',
            text: "Debe ingresar la cantidad de personas beneficiadas.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });

        obj.cantidad_bene.focus();
        return false;
    }

    // Convertir a número para la verificación
    var cantidad_num = parseInt(cantidad_bene, 10);

    // 2. Validar que sea un número positivo (mayor o igual a 1)
    if (isNaN(cantidad_num) || cantidad_num < 1) {
        Swal.fire({
            title: 'Proyecto',
            text: "La cantidad de personas beneficiadas debe ser un número entero positivo (mayor o igual a 1).",
            icon: 'error',
            confirmButtonColor: '#d33',
        });

        obj.cantidad_bene.focus();
        return false;
    }

    var id_ayuda = obj.id_ayuda.value;
    if (!id_ayuda){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una ayuda.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_ayuda.focus();
    return false;
        
    }

    var prioridad = obj.prioridad.value;
    if (!prioridad){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una prioridad.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.prioridad.focus();
    return false;
        
    }
var acta_conformidad_input = obj.acta_conformidad;
var acta_archivos = acta_conformidad_input.files; // Accedemos a la lista de archivos

// 1. Verificar si se seleccionó algún archivo
if (acta_archivos.length === 0) {
    Swal.fire({
        title: 'Proyecto',
        text: "Debe seleccionar al menos un archivo para el acta de conformidad.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
    });
    
    acta_conformidad_input.focus();
    return false;
}

// 2. Validar el formato y tamaño de los archivos
var allowedExtensions = /(\.pdf|\.doc|\.docx|\.jpeg|\.jpg|\.png)$/i;
var maxSize = 5 * 1024 * 1024; // 5MB (debe coincidir con la validación de Laravel)

for (var i = 0; i < acta_archivos.length; i++) {
    var file = acta_archivos[i];
    var fileName = file.name;

    // Validar Extensión
    if (!allowedExtensions.exec(fileName)) {
        Swal.fire({
            title: 'Proyecto',
            text: "El archivo '" + fileName + "' para el acta de conformidad tiene un formato no válido. Solo se permiten PDF, DOC, DOCX, JPEG, y PNG.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });
        acta_conformidad_input.focus();
        return false;
    }
    
}
    var fecha_inicial = obj.fecha_inicial.value;
    if (!fecha_inicial){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una fecha inicial.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.fecha_inicial.focus();
        return (false);
    }
    

     var fechaInicialObj = parseDateInput(fecha_inicial);
    var hoy = new Date();
    // Normalizar a medianoche para solo comparar la fecha y no la hora
    hoy.setHours(0, 0, 0, 0); 
    // fechaInicialObj ya fue normalizada en parseDateInput

    if (!fechaInicialObj < hoy) {
        Swal.fire({
            title: 'Proyecto',
            text: "La Fecha Inicial no puede ser anterior al día de hoy.",
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        obj.fecha_inicial.focus();
        return false;
    }
  
    var fecha_final = obj.fecha_final.value;
    if (!fecha_final){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una fecha final.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        obj.fecha_final.focus();
        return (false);
    }
       
}


//VALIDAR Resposanbles
function  Resposanbles(obj) {
    var cedula = obj.cedula.value;

// Expresión regular para detectar los caracteres especiales
var caracteresEspeciales = /[.*\/]/;

if (!cedula) {
    Swal.fire({
        title: 'Resposanbles',
        text: "Debe de ingresar la cédula.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.cedula.focus();
    return false;
} else if (caracteresEspeciales.test(cedula)) {
    // Si la cédula contiene alguno de los caracteres especiales
    Swal.fire({
        title: 'Error de formato',
        text: "El campo de la cédula no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.cedula.focus();
    return false;
}

// Si la validación pasa, el código continuará su ejecución
   if (cedula.length < 7 || cedula.length > 8){
    Swal.fire({
        title: 'Resposanbles',
        text: "La cédula no puede tener más de 8 dígitos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.cedula.focus();
    return (false);
    }


  // Obtén el campo de nombre para aplicar la validación en tiempo real
var nombreInput = obj.nombre;

// Agrega un evento de teclado para bloquear caracteres no deseados mientras se escriben
nombreInput.onkeydown = function(e) {
    // Definimos los códigos de teclado para los caracteres especiales que queremos bloquear
    // Código del punto '.' es 190
    // Código del asterisco '*' es 56 (cuando se usa la tecla Shift)
    // Código del slash '/' es 191
    var caracteresProhibidos = [190, 191, 56]; 

    // Si el código de la tecla presionada está en nuestra lista de prohibidos...
    if (caracteresProhibidos.includes(e.keyCode)) {
        // Muestra una alerta para informar al usuario
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'El campo del nombre no puede contener puntos (.), asteriscos (*) o barras diagonales (/).',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // ¡Importante! Devuelve `false` para evitar que el carácter se escriba en el campo
        return false;
    }
};

// --- Tu validación para el envío del formulario ---

var nombre = obj.nombre.value;

// 1. Validar que el campo no esté vacío
if (!nombre) {
    Swal.fire({
        title: 'Resposanbles',
        text: "Debe de ingresar un nombre.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.nombre.focus();
    return false;
} 
// 2. Validar que el campo no contenga los caracteres especiales
else if (/[.*\/]/.test(nombre)) {
    Swal.fire({
        title: 'Error en el Nombre',
        text: "El nombre del vocero no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.nombre.focus();
    return false;
}
var nombre = obj.nombre.value;
   if (nombre.length < 3){
       Swal.fire({
           title: 'Resposanbles',
           text: "Faltan dígitos en este campo de nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return (false);
   }
 var nombre = obj.nombre.value;
   if (nombre.trim() == "") {
       Swal.fire({
           title: 'Resposanbles',
           text: "El Campo del nombre no debe contener espacios en blancos.",
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

var apellido= obj.apellido;

// Agregamos un evento de teclado para bloquear caracteres no deseados mientras se escriben
apellido.onkeydown = function(e) {
    // Definimos los códigos de teclado para los caracteres especiales que queremos bloquear
    // Código del punto '.' es 190
    // Código del asterisco '*' es 56 (cuando se usa la tecla Shift)
    // Código del slash '/' es 191
    var caracteresProhibidos = [190, 191, 56]; 

    // Si el código de la tecla presionada está en nuestra lista de prohibidos...
    if (caracteresProhibidos.includes(e.keyCode)) {
        // Muestra una alerta para informar al usuario
        Swal.fire({
            title: 'Error en el apellido',
            text: 'El campo del apellido de vocero no puede contener puntos (.), asteriscos (*) o barras diagonales (/).',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // ¡Importante! Devuelve `false` para evitar que el carácter se escriba en el campo
        return false;
    }
};
 var apellido = obj.apellido.value;
if (!apellido) {
    Swal.fire({
        title: 'Resposanbles',
        text: "Debe de ingresar el apellido.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.apellido.focus();
    return false;
} 
// 2. Validar que no contenga los caracteres especiales
else if (/[.*\/]/.test(apellido)) {
    Swal.fire({
        title: 'Error de formato',
        text: "El apellido no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.apellido.focus();
    return false;
}
// 3. Validar la longitud
else if (apellido.length < 4){
    Swal.fire({
        title: 'Resposanbles',
        text: "Faltan dígitos en este campo de apellido.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.apellido.focus();
    return false;
} 

 var id_cargo  = obj.id_cargo.value;
    if (!id_cargo ){
        Swal.fire({
            title: 'Resposanbles',
            text: "Debe seleccionar un cargo .",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_cargo .focus();
    return false;
        
    }

}

//VALIDAR Visitas
function  Visita(obj) {
    var id_parroquia = obj.id_parroquia.value;
    if (!id_parroquia){
        Swal.fire({
            title: 'Visita',
            text: "Debe de seleccionar una Parroquia",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_parroquia.focus();
        return (false);
    }
    
       var id_comunidad = obj.id_comunidad.value;
    if (!id_comunidad){
        Swal.fire({
            title: 'Visita',
            text: "Debe de seleccionar una comunidad",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_comunidad.focus();
        return (false);
    }
    


  // Obtén el campo de nombre para aplicar la validación en tiempo real
var visitaInput = obj.visita;

// Agrega un evento de teclado para bloquear caracteres no deseados mientras se escriben
visitaInput.onkeydown = function(e) {
    // Definimos los códigos de teclado para los caracteres especiales que queremos bloquear
    // Código del punto '.' es 190
    // Código del asterisco '*' es 56 (cuando se usa la tecla Shift)
    // Código del slash '/' es 191
    var caracteresProhibidos = [190, 191, 56]; 

    // Si el código de la tecla presionada está en nuestra lista de prohibidos...
    if (caracteresProhibidos.includes(e.keyCode)) {
        // Muestra una alerta para informar al usuario
        Swal.fire({
            title: 'Caracter no permitido',
            text: 'El campo del visita no puede contener puntos (.), asteriscos (*) o barras diagonales (/).',
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        
        // ¡Importante! Devuelve `false` para evitar que el carácter se escriba en el campo
        return false;
    }
};

// --- Tu validación para el envío del formulario ---

var visita = obj.visita.value;

// 1. Validar que el campo no esté vacío
if (!visita) {
    Swal.fire({
        title: 'Visitas',
        text: "Debe de ingresar un visita.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.visita.focus();
    return false;
} 
// 2. Validar que el campo no contenga los caracteres especiales
else if (/[.*\/]/.test(visita)) {
    Swal.fire({
        title: 'Error en el visita',
        text: "El visita del vocero no puede contener caracteres especiales como punto (.), asterisco (*) o barra diagonal (/).",
        icon: 'error',
        confirmButtonColor: '#d33',
    });

    obj.visita.focus();
    return false;
}
var visita = obj.visita.value;
   if (visita.length < 3){
       Swal.fire({
           title: 'Resposanbles',
           text: "Faltan dígitos en este campo de visita.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.visita.focus();
       return (false);
   }
 var visita = obj.visita.value;
   if (visita.trim() == "") {
       Swal.fire({
           title: 'Resposanbles',
           text: "El Campo del visita no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.visita.focus();
       return false;
   }

var descripcion_vis = obj.descripcion_vis.value;
    if (!descripcion_vis) {
    Swal.fire({
        title: 'Visitas',
        text: "Debe ingresar la descripción.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion_vis.focus();
    return false;
}

var descripcion_vis = obj.descripcion_vis.value;
if (descripcion_vis.trim() === "") {
    Swal.fire({
        title: 'Visitas',
        text: "El campo de la descripción no debe contener solo espacios en blanco.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion_vis.focus();
    return false;
}

var descripcion_vis = obj.descripcion_vis.value;
if (descripcion_vis.length < 5) {
    Swal.fire({
        title: 'Visitas',
        text: "Faltan dígitos en este campo de texto. La descripción debe tener al menos 5 caracteres.",
        icon: 'warning',
        confirmButtonColor: '#2596ffff',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });

    obj.descripcion_vis.focus();
    return false;
}

    var evidencia_input = obj.evidencia;
    var evidencia_archivos = evidencia_input.files;

    // 1. Validar la presencia del archivo
    if (evidencia_archivos.length === 0) {
        Swal.fire({
            title: 'Visitas',
            text: "Debe seleccionar al menos un archivo o una foto de evidencia.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });
        
        evidencia_input.focus();
        return false;
    }

    // 2. Validar el formato y tamaño de los archivos
    for (var i = 0; i < evidencia_archivos.length; i++) {
        var file = evidencia_archivos[i];
        var fileName = file.name;

        // Validar Extensión
        if (!allowedExtensions.exec(fileName)) {
            Swal.fire({
                title: 'Visitas',
                text: "El archivo '" + fileName + "' de evidencia tiene un formato no válido. Solo se permiten PDF, DOC, DOCX, JPEG, y PNG.",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
            });
            evidencia_input.focus();
            return false;
        }
        
    }

      
}

// Validar Evaluacion
function Evaluaciones (obj) {
    var id_proyecto = obj.id_proyecto.value;
    if (!id_proyecto){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar un proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_proyecto.focus();
    return false;   
    }

    var id_resposanble = obj.id_resposanble.value;
    if (!id_resposanble){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar una responsable.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_resposanble.focus();
    return false;
    }

    
    var observaciones = obj.observaciones.value;
    if (!observaciones) {
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe ingresar una observacion.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.observaciones.focus();
        return false;
    }

    if (observaciones.trim() == "") {
        Swal.fire({
            title: 'Evaluacion',
            text: "El campo de la observacion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.observaciones.focus();
        return false;
    }

    if (observaciones.length < 5){
        Swal.fire({
            title: 'Evaluacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.observaciones.focus();
        return (false);
    }

    var viabilidad = obj.viabilidad.value;
    if (!viabilidad){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar un viabilidad.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.viabilidad.focus();
        return (false);
    }

    var fecha_evalu = obj.fecha_evalu.value;
    if (!fecha_evalu){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar una fecha de evaluacion.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj. fecha_evalu.focus();
        return (false);
    }

    var estatus = obj.estatus.value;
    if (!estatus){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar un estatus.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.estatus.focus();
        return (false);
    }

   }

// Validar Asignacion
function Asignaciones (obj) {
      var id_vocero = obj.id_vocero.value;
            if (!id_vocero){
                Swal.fire({
                    title: 'Asignacion',
                    text: "Debe seleccionar el vocero.",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
                })
                
               obj.id_vocero.focus();
               return (false);
            }

        var id_comunidad = obj.id_comunidad.value;
          if (!id_comunidad){
        Swal.fire({
            title: 'Asignacion',
            text: "Debe de seleccionar una comunidad asignado",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_comunidad.focus();
        return (false);
    }
    var id_ayuda = obj.id_ayuda.value;
    if (!id_ayuda){
        Swal.fire({
            title: 'Asignacion',
            text: "Debe de seleccionar una ayuda asignado",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_ayuda.focus();
        return (false);
    }

       var imagenes = obj.imagenes.value;
    if (!imagenes) {
        Swal.fire({
            title: 'Memoria Fotográfica',
            text: "Debe seleccionar al menos un archivo o una Memoria Fotográfica .",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            // Nota: Aquí no llamamos a this.submit() porque necesitamos archivos.
            // Si el usuario presiona 'OK', simplemente lo dejamos en la página.
        });
        
        obj.imagenes.focus();
        return false;
     }

    var descri_alcance = obj.descri_alcance.value;
    if (!descri_alcance) {
        Swal.fire({
            title: 'Asignacion',
            text: "Debe ingresar la descripcion del alcance.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descri_alcance.focus();
        return false;
    }

    if (descri_alcance.trim() == "") {
        Swal.fire({
            title: 'Asignacion',
            text: "El campo descripcion del alcance no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descri_alcance.focus();
        return false;
    }

    if (/(\w)\2+/i.test(descri_alcance.toLowerCase())) {
    Swal.fire({
            title: 'Asignacion',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.descri_alcance.focus();
        return false;
    }

    if (descri_alcance.length < 5){
        Swal.fire({
            title: 'Asignacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.descri_alcance.focus();
        return (false);
    }

    var presupuesto = obj.presupuesto.value;
    if (!presupuesto) {
        Swal.fire({
            title: 'Asignacion',
            text: "Debe ingresar el presupuesto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.presupuesto.focus();
        return false;
    }

    if (presupuesto.trim() == "") {
        Swal.fire({
            title: 'Asignacion',
            text: "El campo del presupuesto no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.presupuesto.focus();
        return false;
    }

    if (/(\w)\2+/i.test(presupuesto.toLowerCase())) {
    Swal.fire({
            title: 'Asignacion',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.presupuesto.focus();
        return false;
    }

    if (presupuesto.length < 5){
        Swal.fire({
            title: 'Asignacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.presupuesto.focus();
        return (false);
    }

var latitud = obj.latitud.value;
    if (!latitud) {
        Swal.fire({
            title: 'Asignacion',
            text: "Ingrese la Latitud de proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    if (latitud.trim() == "") {
        Swal.fire({
            title: 'Asignacion',
            text: "El campo de la Descripcion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    if (latitud.length < 5){
        Swal.fire({
            title: 'Asignacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.latitud.focus();
        return (false);
    }

    var longitud = obj.longitud.value;
    if (!longitud) {
        Swal.fire({
            title: 'Asignacion',
            text: "Ingrese la Longitud de proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    if (longitud.trim() == "") {
        Swal.fire({
            title: 'Asignacion',
            text: "El campo de la  no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    if (longitud.length < 5){
        Swal.fire({
            title: 'Asignacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.longitud.focus();
        return (false);
    }

 var impacto_ambiental = document.querySelector('input[name="impacto_ambiental"]:checked');
    if (!impacto_ambiental) {
        Swal.fire({
            title: 'Asignacion',
            text: "Debe seleccionar si existe Impacto Ambiental (SI/NO).",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // Enfocar el primer radio button (opcional)
                document.querySelector('input[name="impacto_ambiental"]').focus();
            }
        });

        return false; // Detener el envío del formulario
    }
    
    var impacto_social = document.querySelector('input[name="impacto_social"]:checked');
    if (!impacto_social) {
        Swal.fire({
            title: 'Asignacion',
            text: "Debe seleccionar si existe Impacto Social (SI/NO).",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // Enfocar el primer radio button (opcional)
                document.querySelector('input[name="impacto_social"]').focus();
            }
        });

        return false; // Detener el envío del formulario
    }

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Asignacion',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (direccion.trim() == "") {
        Swal.fire({
            title: 'Asignacion',
            text: "El campo de direccion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    Swal.fire({
            title: 'Asignacion',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.direccion.focus();
        return false;
    }

    if (direccion.length < 5){
        Swal.fire({
            title: 'Asignacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }

var fecha_inicio = obj.fecha_inicio.value;
    if (!fecha_inicio){
        Swal.fire({
            title: 'Asignacion',
            text: "Debe seleccionar una fecha_inicio.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

}

// Validar SEGUIMIENTO
function Seguimiento (obj) {
    
 var responsable_segui = obj.responsable_segui.value;
   if (!responsable_segui) {
       Swal.fire({
           title: 'Seguimiento',
           text: "Ingrese el Nombre del Responsable.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.responsable_segui.focus();
       return false;
   }

    var id_visita = obj.id_visita.value;
   if (!id_visita) {
       Swal.fire({
           title: 'Seguimiento',
           text: "Ingrese el Nombre del visita.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.id_visita.focus();
       return false;
   }

    var detalle_segui = obj.detalle_segui.value;
    if (!detalle_segui) {
        Swal.fire({
            title: 'Seguimiento',
            text: "Ingrese los Detalles del Seguimiento.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.detalle_segui.focus();
        return false;
    }

    if (detalle_segui.trim() == "") {
        Swal.fire({
            title: 'Seguimiento',
            text: "El campo  Detalles de la obra no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.detalle_segui.focus();
        return false;
    }


    if (detalle_segui.length < 5){
        Swal.fire({
            title: 'Seguimiento',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.detalle_segui.focus();
        return (false);
    }

    var fecha_hor = obj.fecha_hor.value;
    if (!fecha_hor){
        Swal.fire({
            title: 'Seguimiento',
            text: "Debe seleccionar una fecha_inicio.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.fecha_hor.focus();
        return (false);
    }

    var gasto = obj.gasto.value;
    if (!gasto) {
        Swal.fire({
            title: 'Seguimiento',
            text: "Debe ingresar el gasto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.gasto.focus();
        return false;
    }
    
    var moneda = obj.moneda.value;
    if (!moneda) {
       Swal.fire({
           title: 'Seguimiento',
           text: "Seleccione una moneda de compra.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.moneda.focus();
        return (false);
    }

    // ** VALIDACIÓN PARA ARCHIVOS (foto_ayuda) **
var evidencia_segui_input = obj.evidencia_segui;
var archivos = evidencia_segui_input.files;

// 1. Validar la presencia del archivo
if (archivos.length === 0) {
    Swal.fire({
        title: 'Evidencia Fotográfica del Seguimientos',
        text: "Debe seleccionar al menos un archivo o una Evidencia.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
    });
    
    evidencia_segui_input.focus();
    return false;
}

// 2. Validar el formato y tamaño de los archivos seleccionados
for (var i = 0; i < archivos.length; i++) {
    var file = archivos[i];
    var fileName = file.name;

    // Validar Extensión
    if (!allowedExtensions.exec(fileName)) {
        Swal.fire({
            title: 'Evidencia Fotográfica del Seguimientos',
            text: "El archivo '" + fileName + "' tiene un formato no válido. Solo se permiten PDF, DOC, DOCX, JPEG, y PNG.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });
        evidencia_segui_input.focus();
        return false;
    }
    
    // Validar Tamaño (Añadido para consistencia)
    if (file.size > maxSize) {
         Swal.fire({
            title: 'Evidencia Fotográfica del Seguimientos',
            text: "El archivo '" + fileName + "' excede el tamaño máximo permitido (5MB).",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });
        evidencia_segui_input.focus();
        return false;
    }
}
    var estado_actual = obj.estado_actual.value;
    if (!estado_actual) {
       Swal.fire({
           title: 'Seguimiento',
           text: "Seleccione un estado actual.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.estado_actual.focus();
        return (false);
    }

    var riesgos = obj.riesgos.value;
    if (!riesgos) {
        Swal.fire({
            title: 'Seguimiento',
            text: "Ingrese los Detalles del riesgo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.riesgos.focus();
        return false;
    }


      
}

// Fin de la validación del Sistema Minas //

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
