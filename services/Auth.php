<?php

namespace app\services;

use app\models\repositories\AuthRepository;
use app\models\repositories\UserRepository;

class Auth {
  // Имя сессии.
  private $ses_name;
  // Значение кнопки submit авторизации.
  private $submit;
  // Значение кнопки submit выхода из сесии.
  private $logout;
  // Значение поля логин.
  private $login;
  // Значение поля пароль.
  private $pass;
  // Оошибки аутентификации.
  private $errors;
  // Значение текущей сессиию
  private $session_id;
  // Доступ к Db.
  private $db;
  // Доступ к Request.
  private $request;
  // Текущий url.
  private $request_uri;
  // Объект зарегистрированного пользователя.
  private $user;

  /**
   * Auth constructor.
   * @param Db $db
   * @param Request $request
   */
  public function __construct(Db $db, Request $request) {
    $this->db = $db;
    $this->request = $request;

    $this->ses_name = 'phpShop';
    $this->logout = $this->request->post('logout') ?? null;

    $postLogin = $this->request->post('login');
    $this->submit = $postLogin['submit'] ?? null;
    $this->login = trim($postLogin['login']) ?? '';
    $this->pass = trim($postLogin['pass']) ?? '';

    // Задаем имя сессии.
    session_name($this->ses_name);
    // Инициализация сессии.
    session_start();

    // Получаем значение текующей сессии.
    $this->session_id = session_id();

    // Если была нажата кнопка выхода из сесии, то выходим из сессии.
    $this->LoginOut();

    // Проверяем зарегистрирован ли идентификатор пользователя.
    $this->CheckAuthUser();
  }

  /**
   * Если была нажата кнопка выхода из сесии, то выходим из сессии.
   */
  private function LoginOut() {
    if (isset($this->logout)) {
      $this->login_out();
    }
  }

  /**
   * Проверяем зарегистрирован ли идентификатор пользователя.
   */
  private function CheckAuthUser() {
    if ($this->check_auth()) {
      // Получаем объект пользователя по login.
      $this->user = (new UserRepository())->getOneWithLogin($_SESSION['user']);
    } else {
      // проверяем бала ли заполнена и отправлена форма авторизации
      if (isset($this->submit) && !empty($this->login) && !empty($this->pass)) {
        // Проверяем существует ли в базе пользователем с полученным именем пользователя и паролем.
        if ($result = (new AuthRepository())->isAuth($this->login, $this->pass)) {
          // Регистрируем идентификатор пользователя.
          $this->reg_session_user();
          // Получаем объект пользователя по login.
          $this->user = (new UserRepository())->getOneWithLogin($this->login);
          // Делаем переадресацию на страницу пользователя.
          header('Location: ../user');
          exit;
        } else {
          $errors[] = "Неправильное имя пользователя или пароль.";
        }
      }
    }
  }

  /**
   * Проверить вошел ли пользователь в систему или нет.
   * @return bool Возвращает true если вошел, иначе - false.
   */
  public function check_auth() {
    if ($_SESSION['user'])
      return true;
    else
      return false;
  }

  /**
   * Функция регистрирует идентификатор пользователя и при необхо димости запоминает куку идентифицирующую пользователя.
   */
  private function reg_session_user() {
    // Регистрируем идентификатор пользоватея
    $_SESSION['user'] = $this->login;
  }

  /**
   * Уничтожаем сессию и связанны с ней данные.
   */
  private function login_out() {
    // Удаляем все переменные сессии.
    $_SESSION = [];

    // Удаляем сессионные cookie.
    if (ini_get("session.use_cookies")) {
      setcookie(session_name(), $this->session_id, time() - 3600000, '/');
    }

    // Уничтожаем сессию.
    session_destroy();

    // Перенапрявляем пользователя после выхода из сеанса.
    header('Location: /user/login');
  }

  public function getUser() {
    return $this->user;
  }

  /***************************************************************
   * Если возникают ошибки аутентификации,
   * возвращается false, иначе - true.
   ***************************************************************/
  public function auth_error() {
    return $this->errors;
  }
}