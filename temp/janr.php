<?php

    $janr = R::findAll('janar');

    foreach($janr as $new):
?>
<div class="select-box__value">
    <input class="select-box__input" type="radio" id="2" value="<?=$new['name']?>" name="janr" checked="checked" />
    <p class="select-box__input-text"><?=$new['name']?></p>
</div>
    <?php endforeach; ?>