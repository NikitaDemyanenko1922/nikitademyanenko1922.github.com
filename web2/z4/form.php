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
  print(<div id="messages">);
  // Выводим все сообщения. 
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

    <form action="/" method="POST">
				<label>
                   name:<br />
                    <input name="field-name-1"
                           value="Input your name" />
                </label><br />

                <label>
                    email:<br />
                    <input name="field-email"
                           value="Input your email"
                           type="email" />
                </label><br />

                <label>
                    Date of Birth:<br />
                    <input name="field-date"
                           value="YEAR-MM-DD"
                           type="date" />
                </label><br />

                gender:<br />
                <label>
                    <input type="radio" checked="checked"
                           name="radio-group-1" value="1" />
                    Male
                </label>
                <label>
                    <input type="radio"
                           name="radio-group-1" value="2" />
                    Female
                </label><br />

                Number of limbs:<br />
                <label>
                    <input type="radio" name="radio-group-2" value="1" />0
                </label>
                <label>
                    <input type="radio" name="radio-group-2" value="2" />1
                </label>
                <label>
                    <input type="radio" name="radio-group-2" value="3" />2
                </label>
                <label>
                    <input type="radio" name="radio-group-2" value="4" />3
                </label>
                <label>
                    <input type="radio" checked="checked" name="radio-group-2" value="5" />4
                </label><br />

                <label>
                    Superpowers:
                    <br />
                    <select name="field-name-3[]"
                            multiple="multiple">
                        <option value="Значение1">immortality</option>
                        <option value="Значение2">Walking through walls</option>
                        <option value="Значение3">Levitation</option>
                    </select>
                </label><br />

                <label>
                    Biography:<br />
                    <textarea name="field-name-2"></textarea>
                </label><br />

                Acquainted with the contract:<br />
                <label>
                    <input type="checkbox"
                           name="check-1" />
                    Signature
                </label><br />

                <input type="submit" value="send" />
    </form>
  </body>
</html>
