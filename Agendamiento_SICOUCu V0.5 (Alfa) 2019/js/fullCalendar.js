 
    // Institucion: Universidad de Cuenca
    // Facultad: Ingenieria
    // Carrera: Sistemas
    // Docente: Dr. Morocho Zurita Carlos Villie
    // Autores: Flores Jhon, Romero Vannesa
    // Modulo: Base de Datps II - (SISTEMAS MALLA 2013)
    // Sistema: SICOUCu V0.5 (Alfa) 2019 - Agendamiento de Citas

    //     Este módulo fue desarrollado como parte de la 
    //     materia Base de Datos II, periodo mar-jul 2019
    
$(document).ready(function(){
    
    $('#CalendarioWeb').fullCalendar({
        //Componentes y Atributos dentro del metodo fullCalendar() 
        header:{
            left: 'prev,today,next',
            center: 'title',
            right: 'agendaDay,agendaWeek,month'
        },
        //date: devielve el click en un formato fecha
        // jsEvent: donde se dio click
        // view: que vista dio click (dia, mes, año)
        // dayClick: muestra el modal para cualquier DIA
        dayClick: function(date, jsEvent, view){

            $('#txtId').val('');
            $('#txtDesc').val('');
            $('#txtHora').val('');
            $('#txtHoraFin').val('');

            $("#selTituloEvento").val("1");
            //Por medio de una referencia se obtiene el MODAL
            // Usa el id del MODAL y con el metodo modal() se ejecuta.
            $("#txtFecha").val(date.format());  //Fecha al dar click
            $("#txtFechaFin").val(date.format());

            // Mostrar y Ocultar selects
            $('#hidden_2').hide();
            $('#hidden_1').show();
            $('#selAgendadorEvento1').removeAttr('disabled');
            $('#selPacienteEvento').removeAttr('disabled');
            $('#selDentistaEvento').removeAttr('disabled');

            $('#btnActualizar').attr("disabled", true);
            $('#btnEliminar').attr("disabled", true);
            $('#btnAgregar').attr("disabled", false);

            $("#eventosModal").modal(); //Muesta Modal
            
        },
        //Agregar colores a los eventos
        // URL con el formato JSON para los Eventos en el Calendario
        events: 'http://localhost:82/Proyecto_BaseDatos/operacionesBD.php',

        // calEvent: evento del calendario
        // jsEvent: eventos que se generan con JavaSript
        //      Al dar click en el calendario se obtiene las caracteristica de cada uno
        //      que va estar en MODEL por medio del array que esta arriba
        // eventClick: muestra el modal para cualquier EVENTO
        eventClick:function(calEvent, jsEvent, view){
            
            
            //Uso del html como metodo para obtener las referencias
            // Titulo de Select
            
            // $('#tituloEvento').val(calEvent.title);
            $("#selTituloEvento").val(calEvent.title);
            // Mostrar informacion de los enventos en el input
            $('#txtId').val(calEvent.id);
            $('#txtDesc').val(calEvent.descripcion);

            FechaHora = calEvent.start._i.split(" ");
            
            $('#txtFecha').val(FechaHora[0]);
            $('#txtHora').val(FechaHora[1]);

            $('#txtFechaAg').val(calEvent.fecha_agenda);

            $('#txtAgendador').val(calEvent.id_agendador);
            $('#selAgendadorEvento1 option[value='+ calEvent.id_agendador +']').attr("selected", true);

            $('#txtPaciente').val(calEvent.id_paciente);
            $('#selPacienteEvento option[value='+ calEvent.id_paciente +']').attr("selected", true);

            $('#txtOdontologo').val(calEvent.id_odontologo);
            $('#selDentistaEvento option[value='+ calEvent.id_odontologo +']').attr("selected", true);

            FechaHoraFin = calEvent.end._i.split(" ");
            
            $('#txtFechaFin').val(FechaHoraFin[0]);
            $('#txtHoraFin').val(FechaHoraFin[1]);

            // Mostrar y Ocultar selects
            $('#hidden_1').hide();
            $('#hidden_2').show();
            $('#selAgendadorEvento1').attr('disabled', 'disabled');
            $('#selPacienteEvento').attr('disabled', 'disabled');
            $('#selDentistaEvento').attr('disabled', 'disabled');

            $('#btnActualizar').attr("disabled", false);
            $('#btnEliminar').attr("disabled", false);
            $('#btnAgregar').attr("disabled", true);

            $("#eventosModal").modal(); //Muesta Modal

        }

    });
    

});


// Obtiene valores del SELECT en el modulo
var valor = "";
function ShowSelected(){
    var select = document.getElementById('selTituloEvento');
    select.addEventListener('change',
    function(){
        valor = this.options[select.selectedIndex].value;
        $('#txtTitulo').val(valor);
    });
}

function ShowSelectedDentista(){
    var select = document.getElementById('selDentistaEvento');
    select.addEventListener('change',
    function(){
        valor = this.options[select.selectedIndex].value;
        $('#txtOdontologo').val(valor);
    });
}

function ShowSelectedPaciente(){
    var select = document.getElementById('selPacienteEvento');
    select.addEventListener('change',
    function(){
        valor = this.options[select.selectedIndex].value;
        $('#txtPaciente').val(valor);
    });
}

function ShowSelectedAgendador(){
    var select = document.getElementById('selAgendadorEvento');
    select.addEventListener('change',
    function(){
        valor = this.options[select.selectedIndex].value;
        $('#txtAgendador').val(valor);
    });
}
