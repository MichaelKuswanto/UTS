<!--Kuis PWL-->
<!--Michael Kuswanto - 2172037-->

<?php
session_start();
if(!isset($_SESSION['registered_user'])) {
    $_SESSION['registered_user'] = false;
}

include_once 'entity/User.php';
include_once 'entity/Ticket.php';
include_once 'entity/Parking.php';
include_once 'dao/PDOUtil.php';
include_once 'dao/UserDao.php';
include_once 'dao/TicketDao.php';
include_once 'dao/ParkingDao.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Programming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    if ($_SESSION['registered_user']) {
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="?menu=Home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=ticket">Ticket Price</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=parking">Parking Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=logout">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <?php
            $navigation = filter_input(INPUT_GET, 'menu');
            switch ($navigation) {
                case 'home':
                    include_once 'pages/home.php';
                    break;
                case 'ticket':
                    include_once 'pages/ticket.php';
                    break;
                case 'parking':
                    include_once 'pages/parking.php';
                    break;
                case 'logout':
                    session_unset();
                    session_destroy();
                    header('location:index.php');
                default:
                    include_once 'pages/home.php';
                    break;
            }
            ?>
        </main>
        <?php
    } else {
        include_once 'pages/login.php';
    }
    ?>
</div>
</body>
</html>