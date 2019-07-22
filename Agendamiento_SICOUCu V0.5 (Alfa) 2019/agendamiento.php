<!-- 
    Institucion: Universidad de Cuenca
    Facultad: Ingenieria
    Carrera: Sistemas
    Docente: Dr. Morocho Zurita Carlos Villie
    Autores: Flores Jhon, Romero Vannesa
    Modulo: Base de Datps II - (SISTEMAS MALLA 2013)
    Sistema: SICOUCu V0.5 (Alfa) 2019 - Agendamiento de Citas

        Este módulo fue desarrollado como parte de la 
        materia Base de Datos II, periodo mar-jul 2019
 -->
<?php
    require_once('conexionBD.php');
    $conexion = conectarBD('postgres');
    // Todo esta validacion debe poner en todos
    // los documentos que vana usar la sesion
    session_start();
    $var_sesion = $_SESSION['s_usuario'];
    //Valida si la variable de sesion
    // esta vacio o no

    if ($var_sesion == null || $var_sesion == "") {
        echo '<script> alert("Advertencia: No tiene autorizacion") </script>';
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendario Web</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="fullcalendar-3.10/js/jquery.min.js"></script>
    <script src="fullcalendar-3.10/js/moment.min.js"></script>
    <!-- Full Calendar -->
    <link rel="stylesheet" href="fullcalendar-3.10/css/fullcalendar.min.css">
    <script src="fullcalendar-3.10/js/fullcalendar.min.js"></script>
    <script src="js/fullCalendar.js"></script>  
    <script src="fullcalendar-3.10/js/es.js"></script>

    <!-- Scripts de JS de Bootstrap va despues de FullCalendar -->
    <!-- fullcalendar-3.10/js/jquery.min.js :: Debe estar colocado anteriormente -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    <style>
    .navbar-custom {
        color: #FFFFFF;
        background-color: #3377FF;
    }
    </style>
</head>
<body>


    <!-- navbar-expand-md: Para agrupar a mas pequeños toda la barra -->
    <!-- navbar-dark: colores de fondo ocuro -->
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
    
        <a class="navbar-brand" href="agendamiento.php">
            <!-- Para nombre producto, empresa -->
            <img src="img/logo_u_cuenca_horizontal.png" width="110" height="30" alt="logo-icono">
            UC Odonto Center
        </a>
        <!-- Para el boton cuando es mas pequeño -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="agendamiento.php">Agendamiento<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Actividades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pagos</a>
                </li>
            </ul>
            <a class="navbar-brand" href="#">
                <img src="img/user.png" width="30" height="30" alt="">
                <?php
                    $query="select * from public.usuario where correo = '".$var_sesion."'";
                    $resultado=pg_query($conexion,$query) or die ("Error en la consulta");
                    $nr=pg_num_rows($resultado);
                    if ($nr>0) {while ($filas=pg_fetch_array($resultado)) {
                        echo $filas["nombres"]." ".$filas["apellidos"];
                    }}
                ?>
            </a>
            <!-- <button class="btn btn-outline-dark my-2 my-sm-0" type="submit"> -->
            <!-- <a href="login.html" class="btn btn-outline-dark my-2 my-sm-0">Iniciar Sesion</a> -->
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?php echo $var_sesion ?>
                    
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="cerrar_sesion.php">Cerrar Sesion</a>
                </div>
            </div>
        </div>
    </nav><br><br>


    
    <!-- Calendario ================================================================== -->
    <!-- Calendario ================================================================== -->
    <div class="container">
        <div class="row">
            <div class="col"></div><br><br>
            <div id="CalendarioWeb"></div>
            <div class="col"></div>
        </div>
    </div>
    

    <!-- Modal Insertar, Modifica, Eliminar========================================== -->
    <!-- Modal Insertar, Modifica, Eliminar========================================== -->
    <div class="modal fade" id="eventosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
    
                <h5 class="modal-title" id="tituloEvento">Detalles de la Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <!-- Datos para MODAL Agregar, Eliminar, Editar -->
                <input type="hidden" id="txtId" name="txtId">
                <input type="hidden" id="txtTitulo" name="txtTitulo">

                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tipo</label>
                            <select class="form-control" name="selTituloEvento" id="selTituloEvento" onclick="ShowSelected();">
                                <option value="1">---</option>
                                <option value="Cita">Cita</option>
                                <option value="Emergencia">Emergencia</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Fecha inicio de cita</label>
                            <input class="form-control" type="text" id="txtFecha" name="txtFecha">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hora inicio de cita</label>
                            <input class="form-control" type="text" id="txtHora" name="txtHora">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Fecha fin de cita</label>
                            <input class="form-control" type="text" id="txtFechaFin" name="txtFechaFin">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hora fin de cita</label>
                            <input class="form-control" type="text" id="txtHoraFin" name="txtHoraFin">
                        </div>
                        <!-- Fecha Actual -->
                        <input type="hidden" id="txtFechaAg" name="txtFechaAg">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Agendador</label>
                            <input class="form-control" type="hidden" id="txtAgendador" name="txtAgendador">

                            <span id="hidden_1">
                            <select class="form-control" name="selAgendadorEvento" id="selAgendadorEvento" onclick="ShowSelectedAgendador();">
                                <option value="1">---</option>
                                <?php
                                    $query="select * from public.usuario where correo = '".$var_sesion."'";
                                    $resultado=pg_query($conexion,$query) or die ("Error en la consulta");
                                    $nr=pg_num_rows($resultado);
                                    if ($nr>0) {while ($filas=pg_fetch_array($resultado)) {
                                        echo "<option  value=".$filas["cedula"].">".$filas["nombres"]." ".$filas["apellidos"]."</option>";
                                    }}
                                ?>
                            </select>
                            </span>

                            <span id="hidden_2">
                            <select class="form-control" name="selAgendadorEvento1" id="selAgendadorEvento1" onclick="ShowSelectedAgendador();">
                                <option value="1">---</option>
                                <?php
                                    $query="select * from public.usuario";
                                    $resultado=pg_query($conexion,$query) or die ("Error en la consulta");
                                    $nr=pg_num_rows($resultado);
                                    if ($nr>0) {while ($filas=pg_fetch_array($resultado)) {
                                        echo "<option  value=".$filas["cedula"].">".$filas["nombres"]." ".$filas["apellidos"]."</option>";
                                    }}
                                ?>
                            </select>
                            </span>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Paciente</label>
                            <input class="form-control" type="hidden" id="txtPaciente" name="txtPaciente">
                            <select class="form-control" name="selPacienteEvento" id="selPacienteEvento" onclick="ShowSelectedPaciente();">
                                <option value="1">---</option>
                                <?php
                                    $query="select * from public.usuario u inner join public.paciente v on u.cedula = v.cedula;";
                                    $resultado=pg_query($conexion,$query) or die ("Error en la consulta");
                                    $nr=pg_num_rows($resultado);
                                    if ($nr>0) {while ($filas=pg_fetch_array($resultado)) {
                                        echo "<option  value=".$filas["cedula"].">".$filas["nombres"]." ".$filas["apellidos"]."</option>";
                                    }}
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Dentista</label>
                            <input class="form-control" type="hidden" id="txtOdontologo" name="txtOdontologo">
                            <select class="form-control" name="selDentistaEvento" id="selDentistaEvento" onclick="ShowSelectedDentista();">
                                <option value="1">---</option>
                                <?php
                                    $query="select * from public.usuario u inner join public.empleado v
                                    on u.cedula = v.cedula inner join public.profesion w on v.id_profesion = w.id_profesion where w.id_profesion = '2'";
                                    $resultado=pg_query($conexion,$query) or die ("Error en la consulta");
                                    $nr=pg_num_rows($resultado);
                                    if ($nr>0) {while ($filas=pg_fetch_array($resultado)) {
                                        echo "<option  value=".$filas["cedula"].">".$filas["nombres"]." ".$filas["apellidos"]."</option>";
                                    }}
                                ?>
                            </select>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Motivo de Consulta</label>
                            <textarea class="form-control" id="txtDesc" rows="3"></textarea>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                <button type="button" id="btnActualizar" class="btn btn-info">Actualizar</button>
                <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                <!-- Script de funciones con los Botones del Modal
                    Necesita los valores del formulario del modal -->
                <script src="js/fullCalendarOp.js"></script>
                
            </div>
            </div>
        </div>
    </div>


</body>
</html>