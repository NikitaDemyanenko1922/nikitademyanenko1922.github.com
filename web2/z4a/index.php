<html>
<head>
<title>Как проверить чекбокс (checkbox) на php - BlogGood.ru</title>
</head>
<body>
<form method="post" action="">
    <!-- ещё кие-то поля -->
    <input type="checkbox" name="my_bloggood-ru" value="1" />
    <input type="submit" name="ок" value="Отправить форму" />
</form>
<?php
if ( empty($_POST['my_bloggood-ru']))
{
echo 'не отмечено';
}
  else {
        echo 'отмечено';
       }
?>
</body>
</html>
