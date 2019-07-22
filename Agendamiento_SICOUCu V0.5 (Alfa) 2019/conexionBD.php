
<?php

    function conectarBD($usuario){
        $host="host=localhost";
        $port="port=5432";
        $dbname="dbname=AgendamientoBD";
        $user="user=".$usuario;
        $password="password=1234";

        $bd = pg_connect("$host $port $dbname $user $password");
        if (!$bd) {
            echo "Error: " .pg_last_error;
        } else {
            // echo "<h3> Conexion Exitosa PHP - Postgres</h3><hr>";
            return $bd;
        }
    }

?>