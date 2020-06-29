<?php
$text = fopen("logFile.txt", "r");
$log = null;
if ($text) {
    while (($buffer = fgets($text)) !== false) {
        $log[] = $buffer;
    }
}
fclose($text);

foreach ($log as $new): ?>
<div class="log-item"><?=$new?></div>
<?php endforeach; ?>