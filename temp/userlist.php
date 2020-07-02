<?php
require_once 'db.php';
$role = 'Пользователь';
$users = R::find('users', 'rol LIKE ?', ["%$role%"]);

foreach ($users as $new): ?>
<tr class="user-list__user">
    <td><?=$new['id']?></td>
    <td><?=$new['login']?></td>
    <td><?=$new['password']?></td>
    <td><?=$new['status']?></td>
    <td><?=$new['rol']?></td>
    <td><?=$new['subscribe']?></td>
</tr>
<?php endforeach; ?>
    