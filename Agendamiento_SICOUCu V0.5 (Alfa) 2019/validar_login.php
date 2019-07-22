 
<?php

    session_start();
    
    $usuario = $_POST['correo'];
    $clave = $_POST['contraseña'];

    $_SESSION['s_usuario'] = $usuario;
    $_SESSION['s_clave'] = $clave;

    require_once('conexionBD.php');
    $conexion = conectarBD('postgres');

    $query="select * from public.usuario where correo = '".$usuario."' and \"contraseña\" = '".$clave."'";
    $resultado=pg_query($conexion,$query) or die ("Error en la consulta");

    $nr=pg_num_rows($resultado);
    if ($nr>0) {
        //Obtener id Perfil para mostrar VISTA de ADMIN o PACIENTE ===============================

        echo "<script>alert('Bienvenido al Sistema de Agendamiento'); window.location= 'agendamiento.php';</script>";
    } else {
        echo "<script>alert('Adevertencia: Usted no esta autentificado'); window.location= 'index.php';</script>";
    }

    pg_free_result($resultado);
    pg_close($conexion);

?>