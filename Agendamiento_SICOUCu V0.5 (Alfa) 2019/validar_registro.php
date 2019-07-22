
 <?php

    require_once('conexionBD.php');
    $conexion = conectarBD('postgres');

    $message = '';
    if (    !empty($_POST['cedula']) &&
            !empty($_POST['nombre']) && !empty($_POST['apellido']) &&
            !empty($_POST['telefono']) && !empty($_POST['fechNac']) &&
            !empty($_POST['genero']) && !empty($_POST['correo']) &&
            !empty($_POST['contraseña'])) {
                
        $varCedula = $_POST['cedula'];
        $varNombre = $_POST['nombre'];
        $varApellido = $_POST['apellido'];
        $varTelefono = $_POST['telefono'];
        $varFechaNacimiento = $_POST['fechNac'];
        $varGenero = $_POST['genero'];
        $varCorreo = $_POST['correo'];
        $varContraseña = $_POST['contraseña'];
        $varDireccion = $_POST['direccion'];

        $query = "INSERT INTO public.usuario (cedula, nombres, apellidos, telefono, genero, correo, \"contraseña\", deuda) 
        VALUES ('".$varCedula."', '".$varNombre."', '".$varApellido."', '".$varTelefono."',
        '".$varGenero."', '".$varCorreo."', '".$varContraseña."', '0')";
        $stmt=pg_query($conexion, $query) or die ("Error en la insersion");
        if (!$stmt) {
            echo '<script>alert("Error al crear la cuenta")</script>';
        }else{
            echo "<script>alert('Cuenta creada con EXITO'); window.location= 'index.php';</script>";
        }


        $query = "INSERT INTO public.paciente (cedula, \"fechaNac\", direccion) 
        VALUES ('".$varCedula."', '".$varFechaNacimiento."', '".$varDireccion."')";
        $stmt=pg_query($conexion, $query) or die ("Error en la insersion");
        if (!$stmt) {
            echo '<script>alert("Error al crear la cuenta")</script>';
        }else{
            echo "<script>alert('Cuenta creada con EXITO'); window.location= 'index.php';</script>";
        }


    } else {
        echo "<script>alert('Falta datos por ingresar'); window.location= 'registro.php';</script>";
        // Añmacenar datos de formulario en JS
    }
   

?>