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
    <title>Inicio de Sesion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="styles/css-login.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {background-color: darkblue;}
        form {margin-top: 15vh;}
    </style>
</head>

<body>
    
    <form action="validar_login.php" method="post">
        <img src="img/logo_ucuenca.png" width="420" height="110">
        <h1>Inicio Sesion</h1>
        <label for="name">Inicie sesion con su correo electronico o si tiene use el correo institucional <b><i>@ucuenca.edu.ec</i></b></label>
        <fieldset>
            <input type="email" id="correo" name="correo" placeholder="Correo electrónico"
                onblur="if(this.placeholder==''){ this.placeholder='Correo electrónico'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Correo electrónico'){ this.placeholder='';}">

            <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña"
                onblur="if(this.placeholder==''){ this.placeholder='Contraseña'; this.style.color='#454545';}"
                onfocus="if(this.placeholder=='Contraseña'){ this.placeholder='';}">

            <button type="submit" id="btnIngresar" class="btn btn-success">Ingresar</button>
            <a href="#">Olvidaste tu contraseña?</a><br><br>
            <button type="button" id="btnCrear" class="btn btn-primary"
                onclick="location.href=
                'http://localhost:82/Proyecto_BaseDatos/registro.php'">
                Crear una nueva cuenta</button>
        </fieldset>
    </form>

</body>

</html>