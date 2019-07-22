    
    // Institucion: Universidad de Cuenca
    // Facultad: Ingenieria
    // Carrera: Sistemas
    // Docente: Dr. Morocho Zurita Carlos Villie
    // Autores: Flores Jhon, Romero Vannesa
    // Modulo: Base de Datps II - (SISTEMAS MALLA 2013)
    // Sistema: SICOUCu V0.5 (Alfa) 2019 - Agendamiento de Citas

    //     Este módulo fue desarrollado como parte de la 
    //     materia Base de Datos II, periodo mar-jul 2019

//Agrega a la interfaz del Calendario

var NuevoEvento = null;

$("#btnAgregar").click(function(){
    // Llamar a la funcion de recolectar datos de GUI
    RecolectarDatosGUI();
    EnviarInformacion('agregar',NuevoEvento);
});

$("#btnEliminar").click(function(){
    // Llamar a la funcion de recolectar datos de GUI
    RecolectarDatosGUI();
    EnviarInformacion('eliminar',NuevoEvento);
});

$("#btnActualizar").click(function(){
    // Llamar a la funcion de recolectar datos de GUI
    RecolectarDatosGUI();
    EnviarInformacion('modificar',NuevoEvento);
});

// Metodo Recolecta los datos para otras operaciones insert, update, delete
function RecolectarDatosGUI(){
    //Estructura de Eventos
    NuevoEvento= {
        id: $('#txtId').val(),
        title: $("#txtTitulo").val(),
        descripcion: $('#txtDesc').val(),
        start: $('#txtFecha').val()+" "+$('#txtHora').val(),
        //Por ahora es la misma fecha y hora
        end: $('#txtFechaFin').val()+" "+$('#txtHoraFin').val(),
        fecha_agenda: $('#txtFechaAg').val(),

        id_agendador: $('#txtAgendador').val(),
        id_paciente: $('#txtPaciente').val(),
        id_odontologo: $('#txtOdontologo').val(),
    };
}


// Usando tecnologia ajax, se envia la informacion sin que la pagina se RECARGUE
function EnviarInformacion(accion,objEvento){
    $.ajax({
        type: 'POST',
        url: 'operacionesBD.php?accion='+accion,
        dataType: "json",
        data:objEvento, //Usa el objeto Evento que consta con todos los valores
        // Luego de la respuesta del php de las operaciones se actualiza el calendario
        success:function(data){
            $('#CalendarioWeb').fullCalendar('refetchEvents');
            $('#eventosModal').modal('toggle'); //Cerrar Modal
        },
        error:function(data){
            // alert("Error EnviarInformacion(): Sucedio un error"+data);
            $('#CalendarioWeb').fullCalendar('refetchEvents');
            $('#eventosModal').modal('toggle'); //Cerrar Modal
        }
    });
}