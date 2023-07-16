function validarFormulario() {
    var email = document.getElementById('Email').value;
    var errorEmail = document.getElementById('errorEmail');

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailRegex.test(email)) {
        errorEmail.textContent = "Por favor, ingresa un correo electrónico válido.";
        return false;
    } else {
        errorEmail.textContent = "";
    }

    return true;
}

function mostrarContrasena() {
    var campoContrasena = document.getElementById("clave");
    if (campoContrasena.getAttribute("type") === "password") {
        campoContrasena.setAttribute("type", "text");
    } else {
        campoContrasena.setAttribute("type", "password");
    }
}
