document.addEventListener('DOMContentLoaded', function() {
  var formulario = document.querySelector('#formulario');

  formulario.addEventListener('submit', function(event) {
    event.preventDefault();

    // Valores de los campos
    var nombre = document.getElementById('Nombre').value;
    var primerApellido = document.getElementById('Primer_Apellido').value;
    var segundoApellido = document.getElementById('Segundo_Apellido').value;
    var email = document.getElementById('Email').value;
    var login = document.getElementById('Login').value;
    var password = document.getElementById('Password').value;

    // Validación de cada campo
    if (!validarNombre(nombre)) {
      alert('El nombre solo puede contener letras.');
      return;
    }

    if (!validarPrimerApellido(primerApellido)) {
      alert('El primer apellido solo puede contener letras.');
      return;
    }

    if (!validarSegundoApellido(segundoApellido)) {
      alert('El segundo apellido solo puede contener letras.');
      return;
    }

    if (!validarEmail(email)) {
      alert('Ingrese un email válido.');
      return;
    }

    if (!validarLogin(login)) {
      alert('Ingrese un login válido.');
      return;
    }

    if (!validarPassword(password)) {
      alert('La contraseña debe tener entre 4 y 8 caracteres.');
      return;
    }

    // Si todas las validaciones pasan, se envía
    HTMLFormElement.prototype.submit.call(formulario); 

  });

  function consultarRegistros() {
   
    console.log('Consultando registros...');
  }

  // Funciones de validación
  function validarNombre(cadena) {
    var pattern = /^[A-Za-záéíóúñÁÉÍÓÚ\s]+$/u;
    return pattern.test(cadena);
  }

  function validarPrimerApellido(cadena) {
    var pattern = /^[A-Za-záéíóúñÁÉÍÓÚ\s]+$/u;
    return pattern.test(cadena);
  }

  function validarSegundoApellido(cadena) {
    var pattern = /^[A-Za-záéíóúñÁÉÍÓÚ\s]+$/u;
    return pattern.test(cadena);
  }

  function validarEmail(email) {
    var pattern = /^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/;
    return pattern.test(email);
  }

  function validarLogin(login) {
    var pattern = /^[A-Za-z0-9]+$/;
    return pattern.test(login);
  }

  function validarPassword(password) {
    return password.length >= 4 && password.length <= 8;
  }

  });
