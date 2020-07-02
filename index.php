<?php 
session_start();
require 'db.php';
include 'wrigthlog.php';

@$user = R::findOne('users', 'login = ?', [$_SESSION['login']]);

if (isset($_GET['exit'])) {
    $text = 'Выход пользователя: '. $_SESSION['login'];
    session_destroy();
    $user->status = 'nactive';
    R::store($user);
    logFile($text);
    header('Location: index.php');
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
    <?php include 'temp/header.php' ?>
    <div class="banner">
        <div class="container">
            <div class="banner__inner">
                <img src="img/banner.png" alt="Banner" class="banner__img">
            </div>
        </div>
    </div>

    <main>
        <div class="films-tile">
            <div class="container">
                <div class="films-tile__inner">
                    <div class="tile">
<!--                        --><?php //include 'temp/film-tile.php'; ?>
                        <div class="tile__item">
                            <img src="img/avatar.png" alt="film-icon" class="tile__img">
                        </div>
                        <div class="tile__item">
                            <img src="img/avatar.png" alt="film-icon" class="tile__img">
                        </div>
                        <div class="tile__item">
                            <img src="img/avatar.png" alt="film-icon" class="tile__img">
                        </div>
                        <div class="tile__item">
                            <img src="img/avatar.png" alt="film-icon" class="tile__img">
                        </div>
                        <div class="tile__item">
                            <img src="img/avatar.png" alt="film-icon" class="tile__img">
                        </div>
                        <div class="tile__item">
                            <img src="img/avatar.png" alt="film-icon" class="tile__img">
                        </div>
                    </div>
                    <div class="side-bar">
                        <div class="side-bar__item">
                            <div class="side-bar__title">Чарт месяца:</div>
                            <ul class="side-bar__list">
                                <li class="side-bar__link"><a href="">Thor</a></li>
                                <li class="side-bar__link"><a href="">Kill bill!</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                            </ul>
                        </div>
                        <div class="side-bar__item">
                            <div class="side-bar__title">Lorem, ipsum:</div>
                            <ul class="side-bar__list">
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                                <li class="side-bar__link"><a href="">Lorem</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="video-slider">
            <div class="container">
                <div class="section-title">
                    <div class="section-title__block">
                        Популярное
                    </div>
                    <div class="section-title__triangle"></div>
                    <div class="section-title__line"></div>
                </div>
                <div class="slide-cards__btns">
                    <div class="slid-cards__btn"><img src="img/prew.png" alt="prew" class="slide-cards__btn"></div>
                    <div class="slid-cards__btn"><img src="img/next.png" alt="next" class="slide-cards__btn"></div>
                </div>
                <div class="slide-cards">
                    <?php include_once 'temp/film-slide.php';?>


                </div>
            </div>
        </div>

        <div class="video-slider">
            <div class="container">
                <div class="section-title">
                    <div class="section-title__block">
                        Новинки
                    </div>
                    <div class="section-title__triangle"></div>
                    <div class="section-title__line"></div>
                </div>
                <div class="slide-cards__btns">
                    <div class="slid-cards__btn"><img src="img/prew.png" alt="prew" class="slide-cards__btn"></div>
                    <div class="slid-cards__btn"><img src="img/next.png" alt="next" class="slide-cards__btn"></div>
                </div>
                    <div class="slide-cards">
                        <div class="slide-cards__card">
                            <img src="img/slide_1.png" alt="slide" class="slide-cards__img">
                            <div class="slide-cards__desc">Lorem ipsum dolor sit amet.</div>
                        </div>
                        <div class="slide-cards__card">
                            <img src="img/slide_1.png" alt="slide" class="slide-cards__img">
                            <div class="slide-cards__desc">Lorem ipsum dolor sit amet.</div>
                        </div>
                        <div class="slide-cards__card">
                            <img src="img/slide_1.png" alt="slide" class="slide-cards__img">
                            <div class="slide-cards__desc">Lorem ipsum dolor sit amet.</div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </main>
    <?php include 'temp/footer.php' ?>
    <script src="js/script.js"></script>
</body>

</html>