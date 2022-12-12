<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$connect = mysqli_connect('localhost', 'root', '', 'database');

if (!$connect)
{
    die('Error connect to DB');
}


if ($name && $email) {
    ?>
    <p>Вы ввели имя <b><?= $name ?></b> и e-mail <b><?= $email ?></b>.</p>
    <?php
    mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `email`, `photo`) VALUES (NULL, '$name', '$email', '$form->file')");
}
?>
<?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])    //not working without <.?php ?.>  ?>
<?= $f->field($form, 'name');                                                //against (pochemy tak) ((syntax html)) ?>
<?= $f->field($form, 'email'); ?>
<?= $f->field($form, 'file')->fileInput() ?>
<?= Html::submitButton('Отправить'); ?>
<?php ActiveForm::end(); ?>

<br></br>
<p>Вывод текущей информации в базе:<p>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli('localhost', 'root', '', 'database');
$mysqli->set_charset("utf8mb4");

$result = $mysqli->query('SELECT * FROM `users`');
while($row = $result->fetch_assoc())
{
echo '<p>Запись id='.$row['id'].'. Имя: '.$row['name'].' Почта:'.$row['email'].'. Имя фото: '.$row['photo'].'</p>';
}
?>