document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let valid = true;

    // Usuario
    const usuario = document.getElementById('usuario');
    const usuarioError = document.getElementById('usuarioError');
    if (usuario.value.trim() === '') {
        usuarioError.style.display = 'block';
        valid = false;
    } else {
        usuarioError.style.display = 'none';
    }

    // Clave
    const clave = document.getElementById('clave');
    const claveError = document.getElementById('claveError');
    if (clave.value.trim() === '') {
        claveError.style.display = 'block';
        valid = false;
    } else {
        claveError.style.display = 'none';
    }

    // Clave 2
    const clave2 = document.getElementById('clave2');
    const clave2Error = document.getElementById('clave2Error');
    if (clave2.value.trim() !== clave.value.trim()) { // Comparar valores de claves
        clave2Error.style.display = 'block';
        valid = false;
    } else {
        clave2Error.style.display = 'none';
    }

    // DNI
    const dni = document.getElementById('dni');
    const dniError = document.getElementById('dniError');
    const dniRegex = /^[0-9]{8}$/; // Corregido a 8 dígitos

    if (!dniRegex.test(dni.value.trim())) {
        dniError.style.display = 'block';
        valid = false;
    } else {
        dniError.style.display = 'none';
    }

    // Nombres
    const nombres = document.getElementById('nombres');
    const nombresError = document.getElementById('nombresError');
    if (nombres.value.trim() === '') {
        nombresError.style.display = 'block';
        valid = false;
    } else {
        nombresError.style.display = 'none';
    }

    // Apellidos
    const apellidos = document.getElementById('apellidos');
    const apellidosError = document.getElementById('apellidosError');
    if (apellidos.value.trim() === '') {
        apellidosError.style.display = 'block'; // Mostrar error correctamente
        valid = false;
    } else {
        apellidosError.style.display = 'none';
    }

    // Validación de correo
    const correo = document.getElementById('correo');
    const correoError = document.getElementById('correoError');
    const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!correoRegex.test(correo.value.trim())) {
        correoError.style.display = 'block';
        valid = false;
    } else {
        correoError.style.display = 'none';
    }

    // Fecha de nacimiento
    const fecha_nacimiento = document.getElementById('fecha_nacimiento');
    const fecha_nacimientoError = document.getElementById('fecha_nacimientoError');
    const fechaNacimientoRegex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/;

    if (!fechaNacimientoRegex.test(fecha_nacimiento.value.trim())) {
        fecha_nacimientoError.style.display = 'block';
        fecha_nacimientoError.textContent = 'La fecha debe tener el formato dd/mm/aaaa.';
        valid = false;
    } else {
        const [dia, mes, anio] = fecha_nacimiento.value.split('/').map(Number);
        const fechaValida = new Date(anio, mes - 1, dia);
        
        if (
            fechaValida.getFullYear() === anio &&
            fechaValida.getMonth() === mes - 1 &&
            fechaValida.getDate() === dia
        ) {
            fecha_nacimientoError.style.display = 'none';
        } else {
            fecha_nacimientoError.style.display = 'block';
            fecha_nacimientoError.textContent = 'La fecha ingresada no es válida.';
            valid = false;
        }
    }

    // Enviar el formulario si todo es válido
    if (valid) {
        alert('Formulario enviado correctamente');
        // Aquí puedes añadir la lógica para enviar el formulario
    } else {
        alert('Por favor, completa todos los campos correctamente.');
    }
});
