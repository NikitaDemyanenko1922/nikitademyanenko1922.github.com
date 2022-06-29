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
<form action="/"
                  method="POST">

                <label>
                  Имя:<br />
                    <input name="name" placeholder="Imput name" autocomplete="off" />
                </label><br />

                <label>
                    email:<br />
                    <input name="email"  placeholder="Imput email" autocomplete="off" type="email" />
                </label><br />

                <label>
                  Дата рождения:<br />
                    <input name="date"
                           value="ГГГГ-ММ-ДД"
                           type="date" />
                </label><br />

                Пол:<br />
                <label>
                    <input type="radio" checked="checked"
                           name="gender" value="1" />
                    М
                </label>
                <label>
                    <input type="radio"
                           name="gender" value="2" />
                    Ж
                </label><br />

                Число конечностей:<br />
                <label>
                    <input type="radio"
                           name="limbs" value="1" />
                    0
                </label>
                <label>
                    <input type="radio"
                           name="limbs" value="2" />
                    1
                </label>
                <label>
                    <input type="radio"
                           name="limbs" value="3" />
                    2
                </label>
                <label>
                    <input type="radio"
                           name="limbs" value="4" />
                    3
                </label>
                <label>
                    <input type="radio" checked="checked"
                           name="limbs" value="5" />
                    4
                </label><br />

                <label>
                Суперспособности:
                    <br />
                    <select name="superpowers[]"
                            multiple="multiple">
                        <option value="1">Бессмертие</option>
                        <option value="2">Прозождение сквозь стены</option>
                        <option value="3">Левитация</option>
                    </select>
                </label><br />

                <label>
                    Биография:<br />
                    <textarea name="bio"></textarea>
                </label><br />

                С контрактом ознакомлен(а):<br />
                <label>
                    <input type="checkbox"
                           name="check-1" />
                    Подпись
                </label><br />

                <input type="submit" value="Отправить" />
            </form>
</body>
</html>
