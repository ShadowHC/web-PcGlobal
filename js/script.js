function redireccionarLogin() {
    window.location.href = "../Login-register/login.php";
  }

  // Obtener los elementos del formulario
  const formulario = document.getElementById('formulario');
  const tipoInput = document.getElementById('tipo');
  const nombreInput = document.getElementById('nombre');
  const correoInput = document.getElementById('correo');
  const motivoInput = document.getElementById('motivo');

  // Validar el formulario antes de enviarlo
  formulario.addEventListener('submit', function(event) {
      event.preventDefault();

      if (!validarTipo()) {
          mostrarError(tipoInput, 'Por favor, seleccione el tipo de PQRS.', 'tipo-error');
      } else {
          mostrarValido(tipoInput, 'tipo-error');
      }

      if (!validarNombre()) {
          mostrarError(nombreInput, 'El nombre solo puede contener letras, minúsculas, mayúsculas y acentos.', 'nombre-error');
      } else {
          mostrarValido(nombreInput, 'nombre-error');
      }

      if (!validarCorreo()) {
          mostrarError(correoInput, 'El correo electrónico no es válido.', 'correo-error');
      } else {
          mostrarValido(correoInput, 'correo-error');
      }

      if (!validarMotivo()) {
          mostrarError(motivoInput, 'El mensaje debe tener un contenido mínimo de 20 palabras.', 'motivo-error');
      } else {
          mostrarValido(motivoInput, 'motivo-error');
      }

      // Si todos los campos son válidos, se envía el formulario
      if (esFormularioValido()) {
          formulario.submit();
      }
  });

  // Función para validar el campo "Tipo de PQRS"
  function validarTipo() {
      return tipoInput.value !== '';
  }

  // Función para validar el campo "Nombre"
  function validarNombre() {
      return nombreInput.value.match(/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/);
  }

  // Función para validar el campo "Correo Electrónico"
  function validarCorreo() {
      return correoInput.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/);
  }

  // Función para validar el campo "Mensaje"
  function validarMotivo() {
      return motivoInput.value.trim().split(/\s+/).length >= 20;
  }

  // Función para mostrar un mensaje de error en un campo
  function mostrarError(campo, mensaje, idError) {
      const grupo = campo.parentElement;
      const mensajeError = grupo.querySelector(`#${idError}`);
      campo.classList.add('formulario__input-error-border');
      mensajeError.textContent = mensaje;
      mensajeError.style.display = 'block';
  }

  // Función para mostrar que un campo es válido
  function mostrarValido(campo, idError) {
      const grupo = campo.parentElement;
      const mensajeError = grupo.querySelector(`#${idError}`);
      campo.classList.remove('formulario__input-error-border');
      mensajeError.textContent = '';
      mensajeError.style.display = 'none';
  }

  // Función para verificar si el formulario es válido
  function esFormularioValido() {
      return !formulario.querySelectorAll('.formulario__input-error-border').length;
  }

document.addEventListener("DOMContentLoaded", function () {
  // Acceder al formulario por su identificador
  const form = document.getElementById("myForm");

  // Agregar un evento para cuando el formulario sea enviado
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Detener el envío del formulario para hacer la validación

    // Realizar la validación de los campos aquí
    if (!validateForm()) {
      // Si la validación falla, no enviar el formulario
      return false;
    }

    // Si la validación es exitosa, enviar el formulario
    form.submit();
  });

  // Función para realizar la validación de los campos
  function validateForm() {
    // Obtener los valores de los campos del formulario
    const tipoPQRS = form.tipo.value;
    const nombre = form.name.value;
    const correo = form.email.value;
    const mensaje = form.mensaje.value;
    const aceptarTerminos = form.aceptar.checked;

    // Realizar la validación de los campos según tus criterios
    // Por ejemplo, aquí puedes verificar que los campos no estén vacíos
    if (tipoPQRS === "") {
      alert("Por favor, seleccione el tipo de PQRS.");
      return false;
    }

    if (nombre === "") {
      alert("Por favor, ingrese su nombre.");
      return false;
    }

    if (correo === "") {
      alert("Por favor, ingrese su correo electrónico.");
      return false;
    }

    // Puedes agregar más validaciones según tus requisitos
    // ...

    if (!aceptarTerminos) {
      alert("Debe aceptar los términos y condiciones.");
      return false;
    }

    // Si todas las validaciones son exitosas, retorna true
    return true;
  }
});