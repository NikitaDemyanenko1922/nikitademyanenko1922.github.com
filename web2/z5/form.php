<html>
  <head>
  <link rel="stylesheet" href="css/style.css" />
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
?>
  <form action="index.php" method="POST">
    <label>
         Имя: <br> 
         <input name="fio" <?php if ($errors_ar['fio']) {print 'class="error"';} ?> 
         value="<?php print $values['fio']; ?>" /> 
    </label> <br>
    <label> 
        E-mail: <br>
        <input name="mail"
               type="email" <?php if ($errors_ar['mail']) {print 'class="error"';} ?> 
               value="<?php print $values['mail']; ?>"/> 
    </label> <br>
    <label>
         Год рождения: <br />
        <select name="year" <?php if ($errors_ar['year']) {print 'class="error"';} ?>>
            <option value="Выбрать">Выбрать</option>
            <?php
                for($i=2004;$i>=1900;$i--){
                    if($values['year']==$i){
                        printf("<option value=%d selected>%d год</option>",$i,$i);
                    }
                    else{
                        printf("<option value=%d>%d год</option>",$i,$i);}
                }
            ?>
        </select>
    </label> <br>
    Пол:<br />
    <label>
      <div <?php if ($errors_ar['gender']) {print 'class="error"';} ?>>
      <input name="gender" type="radio" value="M" <?php if($values['gender']=="M") {print 'checked';} ?>/> мужской
      <input name="gender" type="radio" value="W" <?php if($values['gender']=="W") {print 'checked';} ?>/> женский
    </div> <br />
    Число конечностей:<br /> 
    <div <?php if ($errors_ar['limbs']) {print 'class="error"';} ?>>
      <input name="limbs" type="radio" value="0" <?php if($values['limbs']=="0") {print 'checked';} ?>/> 0 
      <input name="limbs" type="radio" value="1" <?php if($values['limbs']=="1") {print 'checked';} ?>/> 1 
      <input name="limbs" type="radio" value="2" <?php if($values['limbs']=="2") {print 'checked';} ?>/> 2 
      <input name="limbs" type="radio" value="3" <?php if($values['limbs']=="3") {print 'checked';} ?>/> 3 
      <input name="limbs" type="radio" value="4" <?php if($values['limbs']=="4") {print 'checked';} ?>/> 4 
    </div> <br />
    <label> 
        Сверхспособности: 
        <br>
        <select name="power[]" size="3" multiple <?php if ($errors_ar['powers']) {print 'class="error"';} ?>>
            <option value="бессмертие" <?php if($values['immortal']==1){print 'selected';} ?>>бессмертие</option>
            <option value="прохождение сквозь стены" <?php if($values['ghost']==1){print 'selected';} ?>>прохождение сквозь стены</option>
            <option value="левитация" <?php if($values['levitation']==1){print 'selected';} ?>>левитация</option>
        </select>
    </label> <br>
    <label> 
        Биография:<br /> 
        <textarea name="bio" rows="10" cols="15"><?php print $values['bio']; ?></textarea>
    </label> <br>
    <?php 
    $cl_e='';
    $ch='';
    if($values['privacy'] or !empty($_SESSION['login'])){
      $ch='checked';
    }
    if ($errors_ar['privacy']) {
      $cl_e='class="error"';
    }
    if(empty($_SESSION['login'])){
    print('
    <div  '.$cl_e.' >
    <input name="priv" type="checkbox" '.$ch.'> с контрактом ознакомлен(а) <br>
    </div>');}
    ?>
    <input type="submit" value="Отправить"/>
  </form>
  <?php
  if(empty($_SESSION['login'])){
   echo'
   <div class="login">
    <p>Если у вас есть аккаунт, вы можете <a href="login.php">войти</a></p>
   </div>';
  }
  else{
    echo '
    <div class="logout">
      <a href="logout.php" name="logout">Выйти</a>
    </div>';
  } ?>
</body>
</html>