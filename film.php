<?php
session_start();
require 'db.php';
include 'wrigthlog.php';
include 'debug.php';
date_default_timezone_set('UTC');

if (isset($_GET['exit'])) {
    $text = 'Выход пользователя: '. $_SESSION['login'];
    session_destroy();
    $user = R::findOne('users', 'login = ?', [$_SESSION['login']]);
    $user->status = 'nactive';
    R::store($user);
    logFile($text);
    header('Location: index.php');
}



if (isset($_GET['id'])){
    $id = $_GET['id'];
    $date = date('F');
    $film = R::findOne('films', 'id = ?', [$id]);
    if ($date == 'January'){$film->view_january += 1;}
    if ($date == 'February'){$film->view_february += 1;}
    if ($date == 'March'){$film->view_march += 1;}
    if ($date == 'April'){$film->view_april += 1;}
    if ($date == 'May'){$film->view_may += 1;}
    if ($date == 'June'){$film->view_june += 1;}
    if ($date == 'July'){$film->view_july += 1;}
    R::store($film);
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Slab:wght@400;500&display=swap"
        rel="stylesheet">
</head>

<body>
<?php include 'temp/header.php';?>

    <main>
        <div class="film">
            <div class="container">
                <div class="film__inner">
                    <div class="film__banner"><img src="img/side_banner.png" alt="side-banner" class="film__img"></div>
                    <div class="film__info">
                        <div class="title"><?=$film['title'];?></div>
                        <div class="film__desc"><?=$film['desc']?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stats">
            <div class="container">
                <div class="stats__inner">
                    <div onclick="stats()" class="title__spoiler">Статистика просмотра фильма
                        <div class="wipe-btn">
                            <img src="img/wipe.png" alt="wipe-btn" class="wipe-btn__img">
                        </div>
                    </div>
                    <div class="stats__graph">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'temp/footer.php' ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="js/script.js"></script>
</body>

</html>