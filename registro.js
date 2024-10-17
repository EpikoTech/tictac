

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

})
