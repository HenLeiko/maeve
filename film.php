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
                        <li><a href="">Подписка</a></li>
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
        <div class="film">
            <div class="container">
                <div class="film__inner">
                    <div class="film__banner"><img src="img/side_banner.png" alt="side-banner" class="film__img"></div>
                    <div class="film__info">
                        <div class="title">Kill Bill</div>
                        <div class="film__desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                            sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                            laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et
                            quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            dolore magnam aliquam quaerat voluptatem.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stats">
            <div class="container">
                <div class="stats__inner">
                    <div class="title__spoiler">Статистика просмотра фильма
                        <div class="wipe-btn">
                            <img src="img/wipe.png" alt="wipe-btn" class="wipe-btn__img">
                        </div>
                    </div>
                    <div class="stats__graph">
                        
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
</body>

</html>