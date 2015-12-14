<form method="POST" action="?action=author_act">
  <table>
    <tr><td colspan="2">Авторизація</td></tr>
    <tr><td>Логін</td><td><input type="text" name="login"></td></tr>
    <tr><td>Пароль</td><td><input type="password" name="pass"></td></tr>
    <?if(!empty($_GET['error'])){
			echo '<tr><td class="error" colspan="2">'.urldecode(strip_tags($_GET['error'])).'</td></tr>';
			}?>
    <tr><td colspan="2"><input type="submit" value="Увійти"></td></tr>
    <tr><td colspan="2"><a href="?action=regist_form">Реєстрація</a></td></tr>
  </table>
</form>
