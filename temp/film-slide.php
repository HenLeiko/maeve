<?php
$films = R::findAll('films', 'ORDER BY id DESC LIMIT 3');

foreach ($films as $film): ?>
    <a href="film.php?id=<?=$film['id']?>">
<div class="slide-cards__card">
    <img src="resource/film_banners/mini/<?=$film['mini']?>" alt="slide" class="slide-cards__img">
    <div class="slide-cards__desc"><?=$film['mini_desc']?></div>
</div>
    </a>
<?php endforeach; ?>
