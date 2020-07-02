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
<?php include 'temp/header.php' ?>

<div id="wall" class="wall">
    <div class="modal-content">
        <form action="javascript:void(0)" method="POST" class="form__wall">
            <div class="close__block">
                <span class="close-login" onclick="closelogin();">&times;</span>
            </div>
            <h1 class="form__title">Создание записи</h1>
            <textarea name="msg_desc" id="msg_desc" class="wall__textarea"></textarea>
            <div class="button">
                <button class="form__button" id="log" name="log">Создать запись</button>
            </div>
        </form>
    </div>

</div>

        <main>
            <div class="user-info">
                <div class="container">
                    <div class="user-info__inner">
                        <div class="user-info__left">
                            <div class="user-info__status"><?=$user['rol']?></div>
                            <img src="resource/avatars/<?php echo $profile['avatar']; ?>" alt="" class="user-info__img">
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
                                    <div class="user-info__item-right"><?=$profile['reg_date']?></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Последняя активность:</div>
                                    <div class="user-info__item-right"><?=$profile['last_online']?></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Пол:</div>
                                    <div class="user-info__item-right"><?=$profile['sex']?></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Возраст:</div>
                                    <div class="user-info__item-right"><?=$profile['age']?></div>
                                </div>
                                <div class="user-info__item">
                                    <div class="user-info__item-left">Любимый фильм:</div>
                                    <div class="user-info__item-right"><?=$profile['like_film']?></div>
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
                                    <th>Подписка</th>
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

        <?php include 'temp/footer.php' ?>
        <script src="js/script.js"></script>
    </body>

    </html>