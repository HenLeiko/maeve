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
    <header>
        <div id="register" class="register">
            <div class="modal-content">
                    <form action="javascript:void(0)" method="POST" class="form">
                        <div class="close__block">
                            <span class="close-register">&times;</span>
                        </div>
                        <h1 class="form__title">Регистрация</h1>
                        <div class="form__group">
                            <input type="email" class="form__input" name="email" placeholder="Почта">
                        </div>
                        <div class="form__group">
                            <input type="text" class="form__input" name="reg-login" placeholder="Логин">
                        </div>
                        <div class="form__group">
                            <input type="password" class="form__input" name="reg-password" placeholder="Пароль">
                        </div>
                        <div class="form__group">
                            <input type="password" class="form__input" name="repeat-password" placeholder="Повторите пароль">
                        </div>
                        <div class="button">
                            <button class="form__button" onclick="register()" name="reg">Регистрация</button>
                        </div>
                        <div class="error">
                        </div>
                        <div class="form__link">
                            <div class="form__link-login">Авторизация</div>
                        </div>
                    </form>
                </div>

        </div>

        <div id="login" class="login">
            <div class="modal-content">
                    <form action="javascript:void(0)" method="POST" class="form">
                        <div class="close__block">
                            <span class="close-login">&times;</span>
                        </div>
                        <h1 class="form__title">Авторизация</h1>
                        <div class="form__group">
                            <input type="text" class="form__input" name="login" placeholder="Логин">
                        </div>
                        <div class="form__group">
                            <input type="password" class="form__input" name="password" placeholder="Пароль">
                        </div>
                        <div class="button">
                            <button class="form__button" id="log" name="log">Войти</button>
                        </div>
                        <div class="form__remember">
                            <input type="checkbox" name="remember" class="remember" id="remember">Запомнить</div>
                        <div class="error">
                        </div>
                        <div class="form__link">
                            <div class="form__link-register">Регистрация</div>
                        </div>
                    </form>
                </div>

        </div>

        <nav>
            <div class="container">
                <div class="nav__inner">
                    <a href="index.php"><img src="img/maeve_logo_white.png" alt="Logo" class="nav__logo"></a>
                    <a href="" class="nav__link">Новости</a>
                    <a href="" class="nav__link">Категории</a>
                    <a href="" class="nav__link">Топ 100 фильмов</a>
                    <input type="search" name="nav-search" placeholder="Поиск" id="search" class="nav__search">
                    <?php 
                        if (!isset($_SESSION['login'])):
                    ?>
                    <input type="submit" value="Вход/Регистрация" id="auth" class="nav__btn">
                    <?php 
                        endif;
                        if (isset($_SESSION['login'])):
                    ?>
                    <div class="sub">
                    <ul>
                    <a href="profile.php?id=<?=$_SESSION['id']?>"><div class="nav__user">
                    <div class="nav__user-name"><?=$_SESSION['login']?></div>
                    <div class="nav__avatar">
                        <img src="img/avatar.png" alt="" class="nav__img">
                    </div>
                </div></a>
                    <ul class="submenu">
                        <li><a href="sub.php">Подписка</a></li>
                        <li><a href="">Настроки</a></li>
                        <li><a href="?exit">Выход</a></li>
                    </ul>
                    </ul>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </nav>
    </header>

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
                        <input type="submit" value="Оформить" class="card-buy">
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
                        <input type="submit" value="Оформить" class="card-buy">
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
                        <input type="submit" value="Оформить" class="card-buy">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer__inner">
                <div class="footer__information">
                    <div class="footer__logo">
                        <img src="img/maeve_logo_white.png" alt="" class="footer__img">
                    </div>
                    <div class="footer__down">
                        <div class="footer__desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.
                            Risus commodo viverra maecenas accumsan lacus vel facilisis. </div>
                        <div class="footer__contacts">
                            <div class="contacts__up">
                                <div class="contacts__phone">Phone: +7 (900)-255-25-25</div>
                                <div class="contacts__email">Email: email@mail.ru</div>
                            </div>
                            <div class="contscts__down">
                                <a href="https://www.instagram.com/henleiko/"><img src="img/instagram_ico.png"
                                        alt="instagram" class="contacts__soc"></a>
                                <a href="https://www.facebook.com/profile.php?id=100008350997692"><img
                                        src="img/facebook_ico.png" alt="facebook" class="contacts__soc"></a>
                                <a href="https://twitter.com/HenLeiko"><img src="img/twitter_ico.png" alt="twitter"
                                        class="contacts__soc"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <script src="js/script.js"></script>