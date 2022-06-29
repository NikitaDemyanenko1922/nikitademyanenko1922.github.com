<?php
header('Content-Type: text/html; charset=UTF-8');

  $user = 'u47557';
  $pass = '8106867';
  $db = new PDO('mysql:host=localhost;dbname=u47557', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены!.<br>';
    if (!empty($_COOKIE['pass'])) {
      $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass']));
    }
  }

  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['date'] = !empty($_COOKIE['date_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['super'] = !empty($_COOKIE['super_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['check1'] = !empty($_COOKIE['check1_error']);

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages['name_message'] = '<div class="error">Вы не заполнили имя!</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages['email_message'] = '<div class="error">Вы не заполнили e-mail!</div>';
  }
  if ($errors['date']) {
    setcookie('date_error', '', 100000);
    $messages['date_message'] = '<div class="error">Вы не выбрали дату рождения!</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages['gender_message'] = '<div class="error">Вы не указали пол!</div>';
  }
  if ($errors['limbs']) {
    setcookie('limbs_error', '', 100000);
    $messages['limbs_message'] = '<div class="error">Вы не выбрали количество конечностей!</div>';
  }
  if ($errors['super']) {
    setcookie('super_error', '', 100000);
    $messages[] = '<div class="error">Вы не выбрали суперспособность!</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages['bio_message'] = '<div class="error">Вы не рассказали о себе!</div>';
  }
  if ($errors['check1']) {
    setcookie('check1_error', '', 100000);
    $messages['check1_message'] = '<div class="error">Вы не дали согласие на обработку данных!</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['super'] = [];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['check1'] = empty($_COOKIE['check1_value']) ? '' : $_COOKIE['check1_value'];

  $super = array(
    '1' => "1",
    '2' => "2",
	'3' => "3",
  );
  
if(!empty($_COOKIE['super_value'])) {
    $super_value = unserialize($_COOKIE['super_value']);
    foreach ($super_value as $s) {
      if (!empty($super[$s])) {
          $values['super'][$s] = $s;
      }
    }
  }

  if (!empty($_COOKIE[session_name()]) &&
  session_start() && !empty($_SESSION['login'])) {
    try{
      $sth = $db->prepare("SELECT id FROM username WHERE login = ?");
      $sth->execute(array($_SESSION['login']));
      $user_id = ($sth->fetchAll(PDO::FETCH_COLUMN, 0))['0'];
      $sth = $db->prepare("SELECT * FROM application WHERE id = ?");
      $sth->execute(array($user_id));
      
      $values['super'] = [];
      $super_value = unserialize($_COOKIE['super_value']);
        foreach ($super_value as $s) {
            if (!empty($super[$s])) {
                $values['super'][$s] = $s;
            }
        }

      } 
      catch(PDOException $e) {
          print($e->getMessage());
          exit();
      }
  }
  include('form.php');
}

else {
  $errors = FALSE;
// ИМЯ
if (empty($_POST['name'])) {
    setcookie('name_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else if(!preg_match("/^[а-яё]|[a-z]$/iu", $_POST['name'])){
    setcookie('name_error', $_POST['name'], time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }
  // EMAIL
  if (empty($_POST['email'])){
    setcookie('email_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+.[a-zA-Z.]{2,5}$/", $_POST['email'])){
    setcookie('email_error', $_POST['email'], time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }

  // Дата
  if ($_POST['date']=='') {
    setcookie('date_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('date_value', $_POST['date'], time() + 30 * 24 * 60 * 60);
  }

  // ПОЛ
  if (empty($_POST['gender'])) {
    setcookie('gender_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else{
  setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }

  // КОНЕЧНОСТИ
  if (empty($_POST['limbs'])) {
    setcookie('limbs_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
  }

  // СВЕРХСПОСОБНОСТИ
  if(empty($_POST['super'])){
    setcookie('super_error', ' ', time() + 24 * 60 * 60);
    setcookie('super_value', '', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else{
    foreach ($_POST['super'] as $key => $value) {
      $super[$key] = $value;
    }
    setcookie('super_value', serialize($super), time() + 30 * 24 * 60 * 60);
  }

  // ИНФОРМАЦИЯ О СЕБЕ
  if (empty($_POST['bio'])) {
    setcookie('bio_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  }

  // СОГЛАСИЕ
  if (empty($_POST['check1'])) {
    setcookie('check1_error', ' ', time() + 24 * 60 * 60);
    setcookie('check1_value', '', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('check1_value', $_POST['check1'], time() + 30 * 24 * 60 * 60);
  }

  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('date_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('limbs_error', '', 100000);
    setcookie('super_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check1_error', '', 100000);
  }

 if (!empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
    try {
      $stmt = $db->prepare("SELECT id FROM username WHERE login =?");
      $stmt -> execute(array($_SESSION['login'] ));
      $user_id = ($stmt->fetchAll(PDO::FETCH_COLUMN))['0'];

      $stmt = $db->prepare("UPDATE application SET name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ? WHERE id =?");
      $stmt -> execute(array(
          $_POST['name'],
          $_POST['email'],
          $_POST['date'],
          $_POST['gender'],
          $_POST['limbs'],
          $_POST['bio'],
          $user_id,
      ));
      $sth = $db->prepare("DELETE FROM supersss WHERE id = ?");
      $sth->execute(array($user_id));
      $stmt = $db->prepare("INSERT INTO supersss SET id = ?, superpowers = ?");
      foreach($_POST['super'] as $s){
          $stmt -> execute(array(
            $user_id,
            $s,
          ));
        }
      }
    catch(PDOException $e){
      print('Error: ' . $e->getMessage());
      exit();
    }
  }
  else {
    $sth = $db->prepare("SELECT login FROM username");
    $sth->execute();
    $login_array = $sth->fetchAll(PDO::FETCH_COLUMN);
    $flag=true;
    do{
      $login = rand(1,1000);
      $pass = rand(1,10000);
      foreach($login_array as $key=>$value){
        if($value == $login)
          $flag=false;
      }
    }while($flag==false);
    $hash = password_hash((string)$pass, PASSWORD_BCRYPT);
    setcookie('login', $login);
    setcookie('pass', $pass);

    try {
      $stmt = $db->prepare("INSERT INTO application SET name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ?");
      $stmt -> execute(array(
          $_POST['name'],
          $_POST['email'],
          $_POST['date'],
          $_POST['gender'],
          $_POST['limbs'],
          $_POST['bio'],
        )
      );

      $id_db = $db->lastInsertId();
      $stmt = $db->prepare("INSERT INTO supersss SET id = ?, superpowers = ?");
      foreach($_POST['super'] as $s){
          $stmt -> execute(array(
            $id_db,
            $s,
          ));
        }
      $stmt = $db->prepare("INSERT INTO username SET login = ?, pass = ?");
      $stmt -> execute(array(
          $login,
          $hash,
        )
      );
    }
    catch(PDOException $e){
      print('Error: ' . $e->getMessage());
      exit();
    }
  }
  
  setcookie('save', '1');
  header('Location: index.php');
}
