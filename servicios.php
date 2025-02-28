<?php
session_start();

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicio = $_POST['servicio'];
    $_SESSION['servicio'] = $servicio;
    header('Location: profesionales.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sante - Horario</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&family=Noto+Sans&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/989f8affb2.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/santeLogo.jpg">
    <style>
        
    .footer_container{
        display: flex; 
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 75px;  
        color: #000000;
    }

    .iconos_contianer{
        font-size: 30px;
        position: relative;
        right: 0px;
        top: -35px;
        height: 0px !important;
    }

    .iconos_contianer i{
        margin: 10px;
        color:#96B394;
        height: auto;
        padding: 10px;
        border-radius: 100px;
        border: 4px solid #F6EBD5;
    }

    .iconos_contianer i:hover{
        transform: scale(1.1);
        background-color: #F6EBD5;
        transition: .5s;
    }
    </style>
</head>
<body>
    <header>
        <nav class="nav_container">
            <div class="logo_container">
                <img src="img/santeLogo.jpg" alt="Logo" class="logo">
            </div>
        </nav>
    </header>
    <h1 class="servicio_title">SERVICIOS</h1>
    <hr style="margin: auto; width: 40%;">
    <div class="container">
        <div class="row">
            <?php
            $servicios = [
                [
                    'nombre' => 'Drenaje Linfático',
                    'descripcion' => 'Es una técnica manual suave de masaje que ayuda a mejorar el flujo linfático',
                    'precio' => '$ 25000',
                    'duracion' => '1h'
                ],
                [
                    'nombre' => 'Kinesiología',
                    'descripcion' => 'Rehabilitación kinésica Funcional. Trabajamos con obras social, consultanos por los diferenciales.',
                    'precio' => '$ 11000',
                    'duracion' => '1h'
                ],
                [
                    'nombre' => 'Kinesiología Dermatofuncional',
                    'descripcion' => 'Tratamiento de cicatrices, radiofrecuencia, mio up, vela velvet max. Consultanos por los valores!',
                    'precio' => '',
                    'duracion' => '1h'
                ],
                [
                    'nombre' => 'Nutrición',
                    'descripcion' => 'Alimentación basada en plantas y nutrición integral',
                    'precio' => '$ 20000',
                    'duracion' => '1h'
                ],
                [
                    'nombre' => 'Terapia Manual - RPG',
                    'descripcion' => 'RPG, TMR, PUNCIÓN SECA',
                    'precio' => '$ 35000',
                    'duracion' => '1h'
                ],
                [
                    'nombre' => 'Traumatología',
                    'descripcion' => 'La doctora Miriam Rossello es especialista en MIEMBRO SUPERIOR. Consultanos por la cobertura de tu obra social!!',
                    'precio' => '$ 20000',
                    'duracion' => ''
                ],
            ];

            foreach ($servicios as $servicio) {
                echo "
                <div class='col-md-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$servicio['nombre']}</h5>
                            <p class='card-text'>{$servicio['descripcion']}</p>
                            <p class='card-price'>{$servicio['precio']}</p>
                            <p class='card-duration'>{$servicio['duracion']}</p>
                            <form method='POST'>
                                <input type='hidden' name='servicio' value='{$servicio['nombre']}'>
                                <button type='submit' class='btn'>Seleccionar</button>
                            </form>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
    <footer class="footer_container">
        <div class="iconos_contianer">
            <a href="https://www.instagram.com/santecentrodesalud/"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://wa.me/5492915204351"><i class="fa-solid fa-phone"></i></a>
            <a href=""><i class="fa-solid fa-envelope"></i></a>
        </div>
    </footer>
</body>
</html>