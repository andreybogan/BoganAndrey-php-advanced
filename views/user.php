<?php /** @var  \app\models\entity\User $model, $text */ ?>

<a href="/">Вернуться в каталог товаров.</a>

<?php if (isset($_SESSION['user'])): ?>
  <h1>Здравствуйте <?= $model->name ?></h1>
<?php else: ?>
  <p>Эту страницу могу просматривать только зарегистрированные пользователи.</p>
<?php endif; ?>