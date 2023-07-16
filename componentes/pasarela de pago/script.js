function redireccionarLogin() {
  window.location.href = "../Login-register/login.php";
}

const cantidadInput = document.getElementById('cantidad');
cantidadInput.addEventListener('input', () => {
  if (cantidadInput.value < 1) {
    cantidadInput.value = 1;
  }
});