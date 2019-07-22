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
 
 <!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="styles/css-login.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {background-color: darkblue;}
        form {margin-top: 5vh;}
    </style>
</head>

<body>
    
    <form action="validar_registro.php" method="POST">
        <br><h1>Registro de Datos</h1>
        <fieldset>
            <legend><span class="number">A</span>Datos Personales</legend>

            <input type="text" id="cedula" name="cedula" placeholder="Cedula"
                onblur="if(this.placeholder==''){ this.placeholder='Cedula'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Cedula'){ this.placeholder='';}">

            <input type="text" id="nombre" name="nombre" placeholder="Nombres"
                onblur="if(this.placeholder==''){ this.placeholder='Nombres'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Nombres'){ this.placeholder='';}">

            <input type="text" id="apellido" name="apellido" placeholder="Apellidos"
                onblur="if(this.placeholder==''){ this.placeholder='Apellidos'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Apellidos'){ this.placeholder='';}">

            <input type="text" id="telefono" name="telefono" placeholder="Telefono"
                onblur="if(this.placeholder==''){ this.placeholder='Telefono'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Telefono'){ this.placeholder='';}">

            <input type="text" id="direccion" name="direccion" placeholder="Direccion"
                onblur="if(this.placeholder==''){ this.placeholder='Direccion'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Direccion'){ this.placeholder='';}">
            
            <input type="text" id="fechNac" name="fechNac" placeholder="Fecha de Nacimiento"
                onblur="if(this.placeholder==''){ this.placeholder='Fecha de Nacimiento'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Fecha de Nacimiento'){ this.placeholder='';}">
            
            <input type="text" id="genero" name="genero" placeholder="Genero"
                onblur="if(this.placeholder==''){ this.placeholder='Genero'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Genero'){ this.placeholder='';}">

            <legend><span class="number">B</span>Datos Institucionales</legend>

            <input type="email" id="correo" name="correo" placeholder="Correo electrónico"
                onblur="if(this.placeholder==''){ this.placeholder='Correo electrónico'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Correo electrónico'){ this.placeholder='';}">
            
            <input type="text" id="contraseña" name="contraseña" placeholder="Contraseña"
                onblur="if(this.placeholder==''){ this.placeholder='Genero'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Genero'){ this.placeholder='';}">

            <button type="submit" id="btnAgregar" class="btn btn-success">Crear cuenta</button>
        </fieldset>
    </form>

</body>

</html>