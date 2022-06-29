<?php
	header('Content-Type: text/html; charset=UTF-8');

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  	if (!empty($_GET['save'])) {
      print('Спасибо, результаты сохранены.');
  	}
    include('form.php');
 		exit();
	}else {
		$errors = false;
		$limbs = intval($_POST['limbs']);
		$emailReg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
		if(empty($_POST['name'])) {
			print('Заполните Имя. <br/>');
			$errors = true;
		}
		if(empty($_POST['email'])) {
			print('Заполните Email. <br/>');
			$errors = true;
		}else if (!preg_match($emailReg, $_POST['email'])) {
      print('Некорректно введен Email. <br/>');
      $errors = TRUE;
    }
		if(empty($_POST['date'])) {
			print('Заполните Дату. <br/>');
			$errors = true;
		}
		if (empty($_POST['gender'])) {
      print('Заполните Пол. <br/>');
      $errors = TRUE;
    } else if ($_POST['gender'] != 1 && $_POST['gender'] != 2) {
      print('Некорректно введен Пол. <br/>');
      $errors = TRUE;
    }
		if ($limbs < 1 || $limbs > 5) {
			print('<div style="color:red;margin: 5px;border:3px solid red;">Заполните поле Конечностей.</div> <br/>');
      $errors = TRUE;
    } else if ($limbs != 1 && $limbs != 2 &&$limbs != 3 &&$limbs != 4 &&$limbs != 5) {
      print('Некорректно заполнен поле Конечностей. <br/>');
			$errors = TRUE;
    }
		if(empty($_POST['bio'])) {
			print('Заполните Биографию.');
			$errors = TRUE;
		}
		if($errors) {
			include('form.php');
			exit();
		}
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$date = $_POST['date'];
		$gender = $_POST['gender'];
		$limbs = $_POST['limbs'];
		$bio = $_POST['bio'];
	
		try{
			$user = 'u47557';
			$pass = '8106867';

			$db = new PDO('mysql:host=localhost;dbname=u47557', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
      $stmt = $db->prepare("INSERT INTO Udata (name, email, date, gender, limbs, bio) VALUES (:name, :email, :date, :gender, :limbs, :bio)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':date', $fate);
      $stmt->bindParam(':gender', $gender);
      $stmt->bindParam(':limbs', $limbs);
      $stmt->bindParam(':bio', $bio);
			if($stmt->execute()==false){
  			print_r($stmt->errorCode());
  			print_r($stmt->errorInfo());
  			exit();
 			}
		}	catch(PDOException $e){
 				print('Error : ' . $e->getMessage());
  			exit();
		}
		print_r("Новые материалы успешно добавлены, ");
	}

?>
