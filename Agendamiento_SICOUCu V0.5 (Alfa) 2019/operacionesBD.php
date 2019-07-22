<?php
    header('Content-Type: application/json');
    require_once('conexionBD.php');
    // Obtener la conexion de conexionBD

    // Obtener el usuario de la sesion
    $conexion = conectarBD("postgres");

    //Si hay una valor en get[accion], se asignara el valor que tiene
    // el siguiente get[accion], caso contrario sera el valor leer 
    $accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

    switch ($accion) {
        case 'agregar':
            // Instruccion de agregado ======================================================
            // echo "Instruccion AGREGAR\n\n";

            $varTitulo = $_POST['title'];
            $varDescripcion = $_POST['descripcion'];
            $varStart = $_POST['start'];
            $varEnd = $_POST['end'];

            $varAgendador = $_POST['id_agendador'];
            $varPaciente = $_POST['id_paciente'];
            $varOdontologo = $_POST['id_odontologo'];

            $query="INSERT INTO public.cita (title,descripcion,\"start\",\"end\",
            fecha_agenda,id_agendador, id_paciente, id_odontologo)
            VALUES ('".$varTitulo."','".$varDescripcion."','".$varStart."','".$varEnd."',
            CURRENT_TIMESTAMP, '".$varAgendador."','".$varPaciente."','".$varOdontologo."')";
            echo "SQL: ".$query;
            $resultado = pg_query($conexion,$query) or die ("Error en la insersion");
            echo json_encode($resultado);
            

            break;

        case 'eliminar':
            // Instruccion de eliminar ======================================================

            $varId = $_POST['id'];

            $query="DELETE FROM public.cita	WHERE id='".$varId."'";
            echo "SQL: ".$query;
            $resultado = pg_query($conexion,$query) or die ("Error en el borrado");
            echo json_encode($resultado);

            break;
        
        case 'modificar':
            // Instruccion de modificar ======================================================
            
            $varId = $_POST['id'];

            $varTitulo = $_POST['title'];
            $varDescripcion = $_POST['descripcion'];
            $varStart = $_POST['start'];
            $varEnd = $_POST['end'];

            $varAgendador = $_POST['id_agendador'];
            $varPaciente = $_POST['id_paciente'];
            $varOdontologo = $_POST['id_odontologo'];

            $query="UPDATE public.cita
            SET title='".$varTitulo."', descripcion='".$varDescripcion."',
            \"start\"='".$varStart."', \"end\"='".$varEnd."', fecha_agenda=CURRENT_TIMESTAMP,
            id_agendador='".$varAgendador."',
            id_paciente='".$varPaciente."', id_odontologo='".$varOdontologo."'
            WHERE id='".$varId."'";
            
            echo "SQL: ".$query;
            $resultado = pg_query($conexion,$query) or die ("Error en actualizar");
            echo json_encode($resultado);

            break;

        default:
            $query="select * from public.cita";
            $resultado = pg_query($conexion,$query) or die ("Error en la consulta");
            $arr = pg_fetch_all($resultado);
            echo json_encode($arr);
            break;
    }
    

?>