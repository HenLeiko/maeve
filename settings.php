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

    <div class="container">
        <div tabindex="0" class="open-user-settings" onclick="user_settings();">
            <div class="setting-title">Открыть настройки пользователя</div> <img class="open-block"
                src="http://cdn.onlinewebfonts.com/svg/img_295694.svg" alt="Arrow Icon" aria-hidden="true" />
        </div>
        <div class="user-settings">
            <div class="user-settings__inner">
                <form action="upload.php" method="post" enctype="multipart/form-data">
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
                                    <label class="select-box__option" for="2" aria-hidden="aria-hidden">Не
                                        указано</label>
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
                        <label for="avatar" class="age">Загрузка рисунок профиля:</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <input type="submit" class="save" value="Сохранить">
                </form>
            </div>
        </div>

        <div class="clear-fix"></div>

        <div class="admin-settings">
            <div tabindex="0" class="open-admin-settings" onclick="admin_settings();">
                <div class="setting-title">Открыть форму для дабовления фильма</div>
                <img class="open-block" src="http://cdn.onlinewebfonts.com/svg/img_295694.svg" alt="Arrow Icon"
                    aria-hidden="true" />
            </div>
            <div class="admin-settings__emp">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="user-settings__age">
                        <label for="film_title" class="age">Название фильма:</label>
                        <input type="text" name="film_title" id="film_title"><br />
                    </div>
                    <div class="user-settings__age">
                        <label for="film_title" class="age">Жанр:</label>
                        <input type="text" name="film_title" id="film_title"><br />
                    </div>
                    <div class="user-settings__age">
                        <label for="mini" class="age">Загрузка мини обложки для главной:</label>
                        <input type="file" name="mini" id="mini"><br />
                    </div>
                    <div class="user-settings__age">
                        <label for="side" class="age">Загрузка боковой банер для фильма:</label>
                        <input type="file" name="side" id="side"><br />
                    </div>
                    <div class="user-settings__age">
                        <label for="avatar" class="age">Описание фильма:</label>
                        <textarea name="film_desc" id="" cols="30" rows="10"></textarea>
                    </div>
                    <input type="submit" class="save" value="Сохранить">
                </form>
            </div>
        </div>

        <div class="clear-fix"></div>

        <div class="janr-settings">
            <div tabindex="0" class="open-janr-settings" onclick="admin_settings();">
                <div class="setting-title">Открыть форму для дабовления жанра</div>
                <img class="open-block" src="http://cdn.onlinewebfonts.com/svg/img_295694.svg" alt="Arrow Icon"
                    aria-hidden="true" />
            </div>
            <div class="admin-settings__emp">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="user-settings__age">
                        <label for="film_title" class="age">Название жанра:</label>
                        <input type="text" name="film_title" id="film_title"><br />
                    </div>
                    <div class="user-settings__age">
                        <label for="mini" class="age">Загрузка мини обложки для главной:</label>
                        <input type="file" name="mini" id="mini"><br />
                    </div>
                    <div class="user-settings__age">
                        <label for="side" class="age">Загрузка баннера на страницу жанра:</label>
                        <input type="file" name="side" id="side"><br />
                    </div>
                    <input type="submit" class="save" value="Сохранить">
                </form>
            </div>
        </div>
    </div>


    <div class="clear-fix"></div>

    
    <?php include 'temp/footer.php' ?>
    <script src="js/script.js"></script>
</body>

</html>
