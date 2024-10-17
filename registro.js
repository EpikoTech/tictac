

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault()
    let valid = true;

    //usuario
    const usuario = document.getElementById('usuario');
    const usuarioError = document.getElementById('usuarioError');
    if (usuario.value.trim() === "") {
        usuarioError.style.display = 'block';
        valid = false;
    } else {
        usuarioError.style.display = 'none';
    }


    
})
