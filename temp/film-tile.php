<?php

$films = R::findAll('films', 'ORDER BY id LIMIT 6');

foreach ($films as $new): ?>
    <div class="tile__item">
        <img src="resource/film_banners/mini/<?=$new['mini']?>" alt="film-icon" class="tile__img">
    </div>
<?php endforeach; ?>