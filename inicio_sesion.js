//Creando metodos para la validacion de datos
function inicio_sesion() {
    const usuario = $("#nombre_usuario").val();
    const password = $("#password").val();
    let datos = {
        usuario: usuario,
        contraseña: password
    }

    $.ajax({
        url: "verificacion_usuario.php",
        type: "POST",
        data: datos,
        success: function (result) {
            const usuarios = JSON.parse(result);
            var token = 0;
            let validacion = false;
            usuarios.forEach(element => {
                console.log(element.usuario + " " + element.password);
                if ((element.usuario == usuario) && (element.password == password)) {
                    validacion = true;
                    token = element.id;
                }
            });
            if (validacion) {
                window.location.href = "interfaz.html?id=" + token;
            } else {
                alert("Usuario o contraseña incorrectos.");
            }
        }
    })

}