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
    <?php include 'temp/footer.php' ?>
</body>

</html>