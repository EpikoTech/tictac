

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault()
    let valid = true;

    //usuario
    const usuario = document.getElementById('usuario');
    const usuarioError = document.getElementById('usuarioError');
    if (usuario.value.trim() ==='') {
        usuarioError.style.display = 'block';
        valid = false;
    } else {
        usuarioError.style.display = 'none';
    }

    //clave
    const clave = document.getElementById('clave')
    const claveError = document.getElementById('claveError')
    if(clave.value.trim()===''){
        claveError.style.display = 'block';
        valid = false;
    } else {
        claveError.style.display = 'none'
    }

    //clave2
    const clave2 = document.getElementById('clave2')
    const clave2Error = document.getElementById('clave2Error')
    if(clave2.trim() != clave){
        clave2Error.style.display = 'block';
    } else {
        clave2Error.style.display = 'none';
    }

    //dni
    const dni = document.getElementById('dni')
    const dniError = document.getElementById('dniError')
    const dniRegex = /^[0-9]{9}$/;

    if (!dniRegex.test(dni.value.trim())) {
        dniError.style.display = 'block';  
    } else {
        dniError.style.display = 'none'; 
    }
    
    //nombres
    const nombres = document.getElementById('nombres')
    const nombresError = document.getElementById('nombresError')

    if(nombres.trim()===''){
        nombresError.style.display = 'block';
    } else {
        nombresError.style.display = 'none';
    }

    //apellidos
    const apellidos = document.getElementById('apellidos')
    const apellidosError = document.getElementById('apellidosError')
    if(apellidos.trim()===''){
        apellidosError = 'block'
    } else {
        apellidosError = 'none'
    }

    //validacion de correo
    const correo = document.getElementById('correo');
    const correoError = document.getElementById('correoError');


    const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!correoRegex.test(correo.value.trim())) {
        correoError.style.display = 'block';  
    } else {
        correoError.style.display = 'none';  
    }

    const fecha_nacimiento = document.getElementById('fecha_nacimiento')
    const fecha_nacimientoError = document.getElementById('fecha_nacimientoError')


    // Expresión regular para validar el formato dd/mm/yyyy
    const fechaNacimientoRegex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/;

    if (!fechaNacimientoRegex.test(fecha_nacimiento.value.trim())) {
        fecha_nacimientoError.style.display = 'block';  // Mostrar mensaje de error si el formato es incorrecto
        fecha_nacimientoError.textContent = 'La fecha debe tener el formato dd/mm/aaaa.';
    } else {
        // Si el formato es válido, verifica que sea una fecha válida
        const [dia, mes, anio] = fecha_nacimiento.value.split('/').map(Number);
        const fechaValida = new Date(anio, mes - 1, dia);
        
        if (
            fechaValida.getFullYear() === anio &&
            fechaValida.getMonth() === mes - 1 &&
            fechaValida.getDate() === dia
        ) {
            fecha_nacimientoError.style.display = 'none';  // Ocultar mensaje si la fecha es válida
            alert('Fecha de nacimiento válida');
        } else {
            fecha_nacimientoError.style.display = 'block';  // Mostrar error si la fecha no es válida
            fecha_nacimientoError.textContent = 'La fecha ingresada no es válida.';
        }
    }


})
