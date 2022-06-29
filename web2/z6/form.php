<!DOCTYPE html>

<html lang="ru">

  <head>
    <meta charset="UTF-8">
    <title>Zadanie 6</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <?php 
		if (!empty($messages)) {
			if(isset($messages['save'])) print('<div id="messages" class="ok">'); else print('<div id="messages">');
			foreach ($messages as $message) {
				print($message);
			}
		  print('</div>');
		}
	?>
   <a href="login.php">Вход для пользователя</a><br>
   <a href="admin.php">Вход для админа</a>
   <div id="form">
	<form action="" method="POST">

      <label for="name"></label>
        <b>Имя:</b><br />
        <input type="text" name="name" <?php if (!empty($errors['name'])) {print 'class="error"';} ?> 
        <?php if(empty($errors['name'])&&!empty($values['name'])) print 'class="ok"';?> 
        value="<?php isset($_COOKIE['name_error'])? print trim($_COOKIE['name_error']) : print $values['name']; ?>">
      <br />
	  
      <label for="email"></label>
        <b>E-mail:</b><br />
        <input type="text" id="email" name="email" <?php if(!empty($errors['email']))  print 'class="error"';?> 
        <?php if(empty($errors['email'])&&!empty($values['email'])) print 'class="ok"';?> 
        value="<?php isset($_COOKIE['email_error'])? print trim($_COOKIE['email_error']) : print $values['email']; ?>">
      <br />
	  
      <label for="date"><b>Дата рождения:</b></label><br />
        <input type="date" id="date" name="date" <?php if(!empty($errors['date']))  print 'class="error"';?> 
        <?php if(empty($errors['date'])&&!empty($values['date'])) print 'class="ok"';?> 
        value="<?php isset($_COOKIE['date_error'])? print trim($_COOKIE['date_error']) : print $values['date']; ?>">
      <br />
	  
	  <label <?php if(!empty($errors['gender'])) print 'class="error_check"'?>>
      <b>Пол:</b></label><br />
      <input type="radio" id="male"name="gender" value="male" 
        <?php if (isset($values['gender'])&&$values['gender'] == 'male') print("checked"); ?>>
        мужской
      <input type="radio" id="female" name="gender" value="female" 
        <?php if (isset($values['gender'])&&$values['gender'] == 'female') print("checked"); ?>>
        женский<br />
	  
	  <label 
        <?php if(isset($_COOKIE['limbs_error'])) print 'class="error_check"'?>><b>Количество конечностей:</b>
      </label><br />
	<input type="radio" id="0" name="limbs" value="0" 
        <?php if (isset($values['limbs'])&&$values['limbs'] == '0') print("checked"); ?>>
        0
      <input type="radio" id="1" name="limbs" value="1" 
        <?php if (isset($values['limbs'])&&$values['limbs'] == '1') print("checked"); ?>>
        1
	  <input type="radio" id="2" name="limbs" value="2" 
        <?php if (isset($values['limbs'])&&$values['limbs'] == '2') print("checked"); ?>>
        2
	  <input type="radio" id="3" name="limbs" value="3" 
        <?php if (isset($values['limbs'])&&$values['limbs'] == '3') print("checked"); ?>>
        3
      <input type="radio" id="4" name="limbs" value="4" 
        <?php if (isset($values['limbs'])&&$values['limbs'] == '4') print("checked"); ?>>
        4<br />	
	  
	  <b>Сверхспособности:</b><br />
      <label><select name="super[]" multiple="multiple" <?php if (!empty($errors['super'])) print 'class="error"';?>>
        <?php
				$sql = 'SELECT * FROM superdef';
				foreach ($db->query($sql) as $row) {
					?><option value=<?php print $row['id']?> name=super[] 
                    <?php if(isset($values['super'][$row['id']])&&empty($_COOKIE['super_error']))print("checked"); print "\t"; ?>>
					<?php print $row['name'] . "\t";
				}
			?></option>
		</select>
      </label><br />
	  
	  <label for="bio"><b>Биография:</b></label><br />
        <textarea id="bio" name="bio" 
            <?php if(!empty($errors['bio']))  print 'class="error"';?> 
            <?php if(empty($errors['bio'])&&!empty($values['bio'])) print 'class="ok"';?>>
            <?php isset($_COOKIE['bio_error']) ? print trim($_COOKIE['bio_error']) : print $values['bio'] ?>
        </textarea>
      <br />

      <input type="checkbox" id="check1" name="check1" value="check1" 
      <?php if (isset($values['check1'])&&$values['check1'] == 'check1') print("checked"); ?>><br />
      <label <?php if(!empty($errors['check1'])) print 'class="error_check"'?>>
        <b>С контрактом ознакомлен(а)</b>
      </label>
	  
      <p><button type="submit" value="send">отправить</p>

    </form>
	<?php if(!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) 
    print( '<div id="footer">Вход с логином ' . $_SESSION["login"]. '<br> <a href=login.php?do=logout> Выход</a><br></div>');?>
    </div>
  </body>
</html>
