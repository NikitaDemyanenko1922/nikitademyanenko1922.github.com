<html>
  <head>
    <link rel="stylesheet" href="css/style.css" />
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
<div class="col-11 col-md-5 mx-auto">
    <form id="Form" action="" method="POST" accept-charset="UTF-8" >
    <div class="form-row">
    <div class="col-12">
      <label class="text-light form-item"><br />
        Имя:<br />       
        <input class="form-control form-control-md info" name="name" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>" />
      </label><br />
      </div>
      <div class="col-12">
      <label class="text-light form-item"><br />
      Email:<br />     
      <input class="form-control form-control-md info" name="email" type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" />
    </label><br />
      </div>
      <div class="col-12">
      <label class="text-light form-item"><br />
      Дата:<br />      
      <input class="form-control form-control-md info" name="date" type="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>" />
    </label><br />
      </div>
      <div class="col-12">
      <label class="text-light form-item"><br />
      Биография:<br />
       <textarea class="form-control form-control-md info" name="bio" <?php if ($errors['bio']) {print 'class="error"';} ?> value="<?php print $values['bio']; ?>" ></textarea>
      </label><br />
      </div>
      <label class="text-light form-item"><br />
      Подпись:<br />   
      <input id="checkbox" type="checkbox" name="check" required />
    </label><br />
      <label class="text-light form-item">Отправить форму: <input type="submit" value="ok" /></label>
    </div>
    </form>
</div>
</body>
</html>
