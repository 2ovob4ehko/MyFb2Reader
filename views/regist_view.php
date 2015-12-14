<form method="POST" action="?action=regist_act">
  <table>
    <tr><td colspan="2">Реєстрація</td></tr>
    <tr><td>Логін</td><td><input type="text" name="login"></td></tr>
    <tr><td>Пароль</td><td><input type="password" name="pass"></td></tr>
    <?if(!empty($_GET['error'])){
			echo '<tr><td class="error" colspan="2">'.urldecode(strip_tags($_GET['error'])).'</td></tr>';
			}?>
    <tr><td colspan="2"><input type="submit" value="Зареєструватись"></td></tr>
  </table>
</form>
