<?php 
session_start();
require 'db.php';
include 'wrigthlog.php';


if (isset($_GET['exit'])) {
    $text = 'Выход пользователя: '. $_SESSION['login'];
    session_destroy();
    $user = R::findOne('users', 'login = ?', [$_SESSION['login']]);
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

    <main>
        <div class="container">
            <div class="title-cont">
                <h1 class="sub__title">Приобретите подписку и смотрите фильмы в HD</h1>
                <div class="sub__sub-title">У вас уже есть — «Пробная подписка». Хотите большего?</div>
            </div>
            <div class="sub-cards">
                <div class="sub-cards__card">
                    <div class="card__employee">
                        <div class="card__title">Пробная подписка</div>
                        <div class="price">
                            <div class="card__price">50Р</div>
                            <div class="card__date">30 дней</div>
                        </div>
                        <div class="card__desc-cont">
                        <div class="card__desc">— 48 часов фильмов в HD</div>
                    </div>
                        <input type="submit" id="trial" value="Оформить" class="card-buy">
                    </div>
                </div>
                <div class="sub-cards__card">
                    <div class="card__employee">
                        <div class="card__title">Стандартная подписка</div>
                        <div class="price">
                            <div class="card__price">100Р</div>
                            <div class="card__date">30 дней</div>
                        </div>
                        <div class="card__desc-cont">
                        <div class="card__desc">— 48 часов фильмов в HD</div>
                        <div class="card__desc">— Отустсвие рекламы</div>
                    </div>
                        <input type="submit" name="simple" value="Оформить" class="card-buy">
                    </div>
                </div>
                <div class="sub-cards__card">
                    <div class="card__employee">
                        <div class="card__title">Полная подписка</div>
                        <div class="price">
                            <div class="card__price">150Р</div>
                            <div class="card__date">30 дней</div>
                        </div>
                        <div class="card__desc-cont">
                        <div class="card__desc">— 48 часов фильмов в HD</div>
                            <div class="card__desc">— Отсутствие рекламы</div>
                            <div class="card__desc">— Загрузка видео</div>
                            </div>
                        <input type="submit" name="full" value="Оформить" class="card-buy">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'temp/footer.php'?>
    <script src="js/script.js"></script>

