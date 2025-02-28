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

$servicio = $_SESSION['servicio'] ?? '';
$profesionales_por_servicio = [
    'Kinesiología Dermatofuncional' => ['Florencia', 'Constanza'],
    'Nutrición' => ['Maria Paz'],
    'Terapia Manual - RPG' => ['Lucia', 'Mariana'],
    'Traumatología' => ['Miriam'],
    'Drenaje Linfático' => ['Lucia', 'Florencia', 'Constanza'],
    'Kinesiología' => ['Lucia', 'Mauro', 'German Fernandez', 'Gastón Olgiati', 'Melina Thome', 'Hernán López', 'Alejandro Perez'],
];

$profesionales = $profesionales_por_servicio[$servicio] ?? [];

if (empty($profesionales)) {
    $no_profesionales_msg = "
    <div class='falta_profesionalesContainer'>
        <p class='falta_profesionales'>No hay profesionales disponibles para el servicio de $servicio actualmente.</p>
        <hr>
        <span class='falta_profesionales'>Contacta con nuestra sede</span>
        <a href='https://wa.me/5492915347980' class='whatsapp-button' target='_blank'>
            <i style='color: #fff;' class='fa-solid fa-phone'></i>
        </a>
    </div>
    ";
} else {
    $no_profesionales_msg = "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['profesional'] = $_POST['profesional'];
    header('Location: fecha.php');
    exit();
}

// Asociar imágenes a cada profesional
$imagenes_profesionales = [
    'Florencia' => 'img/florencia.jpg',
    'Constanza' => 'img/constanza.jpg',
    'Maria Paz' => 'img/maria.jpg',
    'Lucia' => 'img/lucia.jpg',
    'Mariana' => 'img/mariana.jpg',
    'Miriam' => 'img/miriam.jpg',
    'Mauro' => 'img/mauro.jpg',
    'German Fernandez' => 'img/german.jpg',
    'Gastón Olgiati' => 'img/gastonO.jpg',
    'Melina Thome' => 'img/melina.jpg',
    'Hernán López' => 'img/hernan.jpg',
    'Alejandro Perez' => 'img/alejandro.jpg',
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Profesional</title>
    <link rel="stylesheet" href="css/estilo.css">
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
        top: 0px;
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
    <h1>Seleccionar Profesional para <?php echo htmlspecialchars($servicio); ?></h1>
    <div class="container">
        <div class="row">
            <?php
            if (empty($profesionales)) {
                echo $no_profesionales_msg;
            } else {
                foreach ($profesionales as $profesional) {
                    $imagen = $imagenes_profesionales[$profesional] ?? 'img/default.jpg';
                    echo "
                    <div class='profesionales_container'>
                        <div class='tarjeta'>
                            <div class='img_container'>
                                <img src='$imagen' class='img_profesional' alt='$profesional'>
                            </div>
                            <div class='card-body'>
                                <h5 class='card-title'>$profesional</h5>
                                <form method='POST'>
                                    <input type='hidden' name='profesional' value='$profesional'>
                                    <button type='submit' class='btn'>Seleccionar</button>
                                </form>
                            </div>
                        </div>
                    </div>";
                }
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