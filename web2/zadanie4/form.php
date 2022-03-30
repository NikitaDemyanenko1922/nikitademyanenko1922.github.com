<html>
  <head>
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
  </head>
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

    <form action="" method="POST">
      <label>Имя:       <input name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>" /></label><br />
      <label>Email:     <input name="email" type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" /></label><br />
      <label>Дата:      <input name="date" type="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>" /></label><br />
      <label>Биография: <textarea name="bio" <?php if ($errors['bio']) {print 'class="error"';} ?> value="<?php print $values['bio']; ?>" /></textarea></label><br />
      <label>Подпись:   <input type="checkbox" name="check" <?php if ($errors['check']) {print 'class="error"';} ?> value="<?php print $values['check']; ?>" /></label><br />
      <label>Отправить форму: <input type="submit" value="ok" />
    </form>
  </body>
</html>
