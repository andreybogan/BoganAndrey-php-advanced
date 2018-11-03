<?php /** @var  \app\models\entity\User $errors , $login, $name */ ?>

<a href="/">Вернуться в каталог товаров.</a>

<h1>Регистрация пользователя</h1>

<?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
    <p>
        <label for="name">Имя пользователя:</label>
        <input type="text" id="name" name="reg[name]" value="<?= $name ?>" size="30">
    </p>
    <p>
        <label for="login">Логин:</label>
        <input type="text" id="login" name="reg[login]" value="<?= $login ?>" size="30">
    </p>
    <p>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="reg[pass]" value="" size="30">
    </p>
    <p><input type="submit" name="reg[submit]" value="Зарегистрироваться" style="width: auto;"></p>
</form>