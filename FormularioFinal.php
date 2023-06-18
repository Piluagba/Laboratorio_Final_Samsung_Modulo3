<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario de registro</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div class="group">
        

            <form method="POST" action="" id="formulario">
            <h2><em>¡Registrate gratis!</em></h2>


        <label for="Nombre">Nombre<span><em>(requerido)</em></span></label><br>
        <input type="text" id= "Nombre" name="Nombre" class="form-input" required maxlength="25"/>
        
        <br>

        <label for="Primer_Apellido">Primer Apellido<span><em>(requerido)</em></span></label><br>
        <input type="text" id="Primer_Apellido" name="Primer_Apellido" class="form-input" required maxlength="25"/>
        <br>

        <label for="Segundo_Apellido">Segundo Apellido<span><em>(requerido)</em></span></label><br>
        <input type="text" id="Segundo_Apellido" name="Segundo_Apellido" class="form-input" required maxlength="25"/>
        
        <br>

        <label for="Login">Login<span><em>(requerido)</em></span></label><br>
        <input type="text" id="Login" name="Login" class="form-input" required maxlength="25"/>
        
        <br>
       
        <label for="Password">Password<span><em>(requerido)</em></span></label><br>
        <input type="password" id= Password name="Password" class="form-input" required maxlength="8"/>

        <br>

        <label for="Email">Email<span><em>(requerido)</em></span></label><br>
        <input type="email" id=Email name="Email" class="form-input" required maxlength="20"/>
        
        <br>
        <input class="form-btn" id=submit name="submit" type="submit" value="Suscribirse"/>
        
        <input class="form-btn" type="button" value="Consultar Registros" id="btnConsultarRegistros">

<?php

function validarEmail($Email) {
    $pattern = '/^[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/';
    return preg_match($pattern, $Email);
}

function validarNombre($cadena) {
    $pattern = '/^[A-Za-záéíóúñÁÉÍÓÚ\s]+$/u';
    return preg_match($pattern, $cadena);
}

function validarPrimer_Apellido($cadena) {
    $pattern = '/^[A-Za-záéíóúñÁÉÍÓÚ\s]+$/u';
    return preg_match($pattern, $cadena);
}

function validarSegundo_Apellido($cadena) {
    $pattern = '/^[A-Za-záéíóúñÁÉÍÓÚ\s]+$/u';
    return preg_match($pattern, $cadena);
}


if ($_POST) {
    $Nombre = $_POST['Nombre'];
    $Primer_Apellido = $_POST['Primer_Apellido'];
    $Segundo_Apellido = $_POST['Segundo_Apellido'];
    $Email = $_POST['Email'];
    $Login = $_POST['Login'];
    $Password = $_POST['Password'];

//Validación de los campos nombre y apellidos que no sea numérica
if (!validarNombre($Nombre)) {
    echo "<br>El nombre solo puede contener letras.";
    return;
}

if (!validarPrimer_Apellido($Primer_Apellido)) {
    echo "<br>El primer apellido solo puede contener letras.";
    return;
}

if (!validarSegundo_Apellido($Segundo_Apellido)) {
    echo "<br>El segundo apellido solo puede contener letras.";
    return;
}
//Validación correo electrónico
if (!filter_var ($Email, FILTER_VALIDATE_EMAIL)){
    echo "<br>Ingrese un email válido.";
    return;
}

//Validación longitud de la contraseña
if (strlen($Password) < 4 || strlen($Password) > 8) {
    echo "<br>La contraseña debe tener entre 4 y 8 caracteres.";
    return;
}

//Conexion con PDO

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulariofinal";

//Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

//Check conexión
if ($conn->connect_error){
    die("connection failed:". $conn->connection_error);
}

// Verificar si el correo electrónico ya está registrado
$sql = "SELECT * FROM usuario WHERE Email = '$Email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<br>El correo electrónico ya está registrado.";
    $conn->close();
    return;
}
 //Cifrar la contraseña
 $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

//Insertar usuario

$sql = "INSERT INTO usuario (Nombre, Primer_Apellido, Segundo_Apellido, Email,Login, Password) VALUES ('$Nombre', '$Primer_Apellido','$Segundo_Apellido', '$Email','$Login','$passwordHash')";

if ($conn->query($sql) === TRUE){
    echo "<br>Usuario registrado correctamente";
} else{ 
    echo "Error:" . $sql . "<br>" . $conn->error;
}

if (isset($_POST['consultarRegistros'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "formulariofinal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM usuario"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<br>Registros encontrados:<br>";

        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["ID"] . "<br>";
            echo "Nombre: " . $row["Nombre"] . "<br>";
            echo "Primer Apellido: " . $row["Primer_Apellido"] . "<br>";
            echo "Segundo Apellido: " . $row["Segundo_Apellido"] . "<br>";
            echo "Email: " . $row["Email"] . "<br>";
            echo "Login: " . $row["Login"] . "<br>";
            echo "<br>";
        }
    } else {
        echo "<br>No se encontraron registros.";
    }

    $conn->close();
} 
}


?>

            </form>
        </div>
        <script src="script.js"></script>
    </body>
</html>