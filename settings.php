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
                        <input type="password" class="form__input" name="repeat-password"
                            placeholder="Повторите пароль">
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
                            <a href="profile.php?id=<?=$_SESSION['id']?>">
                                <div class="nav__user">
                                    <div class="nav__user-name"><?=$_SESSION['login']?></div>
                                    <div class="nav__avatar">
                                        <img src="img/avatar.png" alt="" class="nav__img">
                                    </div>
                                </div>
                            </a>
                            <ul class="submenu">
                                <li><a href="sub.php">Подписка</a></li>
                                <li><a href="settings.php">Настроки</a></li>
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

    <div class="container">
        <div tabindex="0" class="open-user-settings" onclick="user_settings();"><div class="setting-title">Открыть настройки пользователя</div> <img class="open-block" src="http://cdn.onlinewebfonts.com/svg/img_295694.svg"
                alt="Arrow Icon" aria-hidden="true" /></div>
        <div class="user-settings">
            <div class="user-settings__inner">
                <div class="user-settings__sex">
                    <label for="sex" class="sex">Ваш пол:</label>
                    <div class="select-box" id="sex">
                        <div class="select-box__current" tabindex="1">
                            <div class="select-box__value">
                                <input class="select-box__input" type="radio" id="0" value="мужской" name="sex"
                                    checked="checked" />
                                <p class="select-box__input-text">Мужской</p>
                            </div>
                            <div class="select-box__value">
                                <input class="select-box__input" type="radio" id="1" value="женский" name="sex"
                                    checked="checked" />
                                <p class="select-box__input-text">Женский</p>
                            </div>
                            <div class="select-box__value">
                                <input class="select-box__input" type="radio" id="2" value="не указано" name="sex"
                                    checked="checked" />
                                <p class="select-box__input-text">Не указано</p>
                            </div>
                            <img class="select-box__icon" src="http://cdn.onlinewebfonts.com/svg/img_295694.svg"
                                alt="Arrow Icon" aria-hidden="true" />
                        </div>
                        <ul class="select-box__list">
                            <li>
                                <label class="select-box__option" for="0" aria-hidden="aria-hidden">Мужской</label>
                            </li>
                            <li>
                                <label class="select-box__option" for="1" aria-hidden="aria-hidden">Женский</label>
                            </li>
                            <li>
                                <label class="select-box__option" for="2" aria-hidden="aria-hidden">Не указано</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="user-settings__age">
                    <label for="age" class="age">Ваш возраст:</label>
                    <input type="text" class="age__input" placeholder="Возраст" name="age" id="age">
                </div>
                <div class="user-settings__age">
                    <label for="film" class="age">Ваш любимый фильм:</label>
                    <input type="text" class="age__input" placeholder="Фильм" name="film" id="film">
                </div>
                <div class="user-settings__age">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <label for="film" class="age">Загрузить рисунок профиля:</label>
                        <input type="file" name="mini" id="mini">
                    </form>
                </div>
            </div>
        </div>
        <div class="page-settings"></div>
        <div class="admin-settings"></div>
    </div>


    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="text" name="film_title" id=""><br />
        <textarea name="film_desc" id="" cols="30" rows="10"></textarea><br />
        <input type="file" name="mini" id=""><br />
        <input type="file" name="side" id=""><br />
        <input type="submit" value="Отправить">
    </form>



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
</body>

</html>