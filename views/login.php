<a href="/">Вернуться в каталог товаров.</a>

<h1>Вход на сайт</h1>

<?php if (isset($errors)): ?>
  <?php foreach ($errors as $error): ?>
    <p style="color: red;"><?= $error ?></p>
  <?php endforeach; ?>
<?php endif; ?>

<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
  <p>
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login[login]" value="<?= $login ?>" size="30">
  </p>
  <p>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="login[pass]" value="<?= $pass ?>" size="30">
  </p>
  <p><input type="submit" name="login[submit]" value="Войти" style="width: auto;"></p>
</form>