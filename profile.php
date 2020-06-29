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

$id = $_GET['id'];
$profile = R::findOne('profiles', 'id = ?', [$id]);
$user = R::findOne('users', 'id = ?', [$id]);

if (empty($_SESSION['login'])){
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
            <div class="user-info">
                <div class="container">
                    <div class="user-info__inner">
                        <div class="user-info__left">
                            <div class="user-info__status"><?=$user['rol']?></div>
                            <img src="img/avatar.png" alt="" class="user-info__img">
                            <div class="user-info__user-name"><?=$user['login']?></div>
                            <div class="user-info__ps">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed u
                            </div>
                        </div>
                        <div class="user-info__right">
                            <div class="user-info__title">
                                <div class="user-info__about-user">О пользователе</div>
                                <div class="user-info__send-msg">Отправить сообщение</div>
                            </div>
                            <div class="user-info__user-stats">
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Дата регистрации:</div>
                                    <div class="user-info__item-right"></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Последняя активность:</div>
                                    <div class="user-info__item-right"></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Пол:</div>
                                    <div class="user-info__item-right"></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Возраст:</div>
                                    <div class="user-info__item-right"></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Любимый фильм:</div>
                                    <div class="user-info__item-right"></div>
                                </div>
                            </div>
                            <div class="user-info__title">
                                <div class="user-info__name-title">Записи пользователя</div>
                                <div class="user-info__send-news">Новая запись</div>
                            </div>
                            <div class="user-info__news">
                                <div class="user-info__avatar-mini"><img src="img/avatar.png" alt=""
                                        class="user-info__img-mini"></div>
                                <div class="user-info__news-desc">Lorem ipsum, dolor sit amet consectetur adipisicing
                                    elit.
                                    Fuga, iusto. Culpa nihil cum assumenda facere!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">

                <?php if ($profile['id'] == $_SESSION['id'] && $user['rol'] == 'Администратор'): ?>

                <div class="section-title">
                    <div class="section-title__block">
                        Админ-меню
                    </div>
                    <div class="section-title__triangle"></div>
                    <div class="section-title__line"></div>
                </div>
                <div class="admin-panel">
                    <div class="admin-panel__item" onclick="userlist()" id="user-list">Список пользователей</div>
                    <div class="admin-panel__item" onclick='adminlist()' id="admin-list">Список администрации</div>
                    <div class="admin-panel__item" id="last-subs">Последнии подписки</div>
                    <div class="admin-panel__item" onclick='logs()' id="logs">Логи</div>
                </div>
            </div>



            <!-- admin functions -->

            <div class="user-list">
                <div class="container">
                    <div class="user-list__title">
                        <table>
                            <thead>
                                <tr class="user-list__tit">
                                    <th>id</th>
                                    <th>Логин</th>
                                    <th>Пароль</th>
                                    <th>Статус</th>
                                    <th>Роль</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include ('temp/userlist.php'); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div class="admin-list">
                <div class="container">
                    <div class="user-list__title">
                        <table>
                            <thead>
                                <tr class="user-list__tit">
                                    <th>id</th>
                                    <th>Логин</th>
                                    <th>Пароль</th>
                                    <th>Статус</th>
                                    <th>Роль</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include ('temp/adminlist.php'); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="log-list">
                <div class="container">
                    <div class="log-list__title">
                        <?php include 'temp/readlog.php'; ?>
                    </div>
                </div>
            </div>


            <?php endif; ?>

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
                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                gravida.
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