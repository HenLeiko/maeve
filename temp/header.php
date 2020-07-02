<header>
        <div id="register" class="register">
            <div class="modal-content">
                <form action="javascript:void(0)" method="POST" class="form">
                    <div class="close__block">
                        <span class="close-register" onclick="closeregister();">&times;</span>
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
                        <div class="form__link-login" onclick="login();">Авторизация</div>
                    </div>
                </form>
            </div>

        </div>

        <div id="login" class="login">
            <div class="modal-content">
                <form action="javascript:void(0)" method="POST" class="form">
                    <div class="close__block">
                        <span class="close-login" onclick="closelogin();">&times;</span>
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
                    <div class="log-error">
                    </div>
                    <div class="form__link">
                        <div class="form__link-register" onclick="reg();">Регистрация</div>
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
                    <input type="submit" onclick="auth();" value="Вход/Регистрация" id="auth" class="nav__btn">
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
                                        <img src="resource/avatars/<?php echo $_SESSION['avatar']?>" alt="" class="nav__img">
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