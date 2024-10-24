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
function nuevo_usuario(){
    const usuario= $('#usuario').val();
    const password= $('#clave').val();
    const dni= $('#dni').val();
    const nombre= $('#nombres').val();
    const apellidos= $('#apellidos').val();
    const correo = $('#correo').val();
    const telefono = $('#telefono').val();
    const fecha_n =$('#fecha_nacimiento').val();
    var checkbox = document.getElementById("activacion");
    var checkbox_term_con = checkbox.checked ? 1 : 0;
    let datos = {
        usuario: usuario,
        password: password,
        dni:dni,
        nombre:nombre,
        apellidos:apellidos,
        correo: correo,
        telefono: telefono,
        fecha_nacimiento: fecha_n,
        check: checkbox_term_con
    }
    
    $.ajax({
        url:'nuevo_usuario.php',
        type:'POST',
        data:datos,
        success:function(response){
            
        }
    })
}