<?php
/**
 * Created by PhpStorm.
 * User: Andrey Bogan
 * Date: 29.10.2018
 */

namespace app\base;

use app\traits\TSingleton;

/**
 * Class App определяет все наше приложение.
 * @package app\base
 * @property $db;
 * @property $request;
 * @property $session;
 * @property $renderer;
 * @property $auth;
 */
class App
{
    // Подключаем Singleton.
    use TSingleton;

    /** @var array Конфигурация приложения. */
    public $config;

    /** @var array Массив объектов компонентов. */
    private $components = [];

    /** @var array Массив объектов репозиториев. */
    private $repositories = [];

    /** @return App Возвращает экземпляр нашего приложения. */
    public static function call()
    {
        return static::getInstance();
    }

    /**
     * Метод запускает наше приложение.
     * @param $config - Конфигурация приложения.
     */
    public function run($config)
    {
        // Инициализируем данные конфигурации
        $this->config = $config;
        // Инициализиурем классы хранения.
        $this->components = new ComponentsStorage();
        $this->repositories = new RepositoriesStorage();
        // Вызываем метод контроля и запуска приложения.
        $this->runController();
    }

    /**
     * Метод контроля и запуска нашего приложения.
     */
    private function runController()
    {
        // Получаем имена controller and action.
        $controllerName = $this->request->getControllerName() ?: $this->config['defaultController'];
        $actionName = $this->request->getActionName();

        // Получаем имя класса.
        $controllerClass = $this->config['controllersNamespace'] . "\\" . ucfirst($controllerName) . "Controller";

        try {
            // Если класс контроллера существует, то инициализируем и запускаем его.
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass($this->renderer, $this->auth);
                $controller->run($actionName);
            } else {
                throw new \Exception('Нет такого конструктора');
            }
        } catch (\Exception $e) {
            Header('Location: /error404');
        }
    }

    /**
     * Метод создает объект заданного компонента и возвращает его.
     * @param string $name - Название компонента.
     * @return object Возвращает объект заданного компонента.
     * @throws \ReflectionException
     */
    public function createComponent($name)
    {
        // Получаем название компонента.
        $params = $this->config['components'][$name];
        if (isset($params)) {
            // Получаем класс компонента.
            $class = $params['class'];
            if (class_exists($class)) {
                // Удаляем параметр class, так как его не нужно передавать.
                unset($params['class']);
                // Получаем объект заданног класса с переданными в него значения, и возвращаем его.
                return $this->getObject($class, $params);
            } else {
                throw new \Exception("Не определен класс компонента.");
            }
        } else {

            throw new \Exception("Компонент {$name} не найден.");
        }
    }

    /**
     * Метод создает объект заданного репозитория и возвращает его.
     * @param string $name - Название репозитория.
     * @return object Возвращает объект заданного репозитория.
     * @throws \ReflectionException
     */
    public function createRepository($name)
    {
        // Получаем класс репозитория.
        $class = $this->config['repositoriesNamespace'] . '\\' . $name;
        if (class_exists($class)) {
            $params = [];
            // Получаем объект заданног класса с переданными в него значения, и возвращаем его.
            return $this->getObject($class, $params);
        } else {
            throw new \Exception("Репозиторий {$name} не найден.");
        }
    }

    /**
     * Получаем объект заданног класса с переданными в него значения, и возвращаем его.
     * @param string $class - Создаваемы класс.
     * @param array $params - Параметры необходимые для создания объекта класс.
     * @return object Возвращает объект заданного компонента или репозитория.
     * @throws \ReflectionException
     */
    private function getObject($class, $params)
    {
        $reflection = new \ReflectionClass($class);
        return $reflection->newInstanceArgs($params);
    }

    /**
     * Метод возвращает объект запрашиваемого компонента.
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // Если запрашиваемый параметр есть в списке компонентов, то возвращаем объект этого компонента.
        if (isset($this->config['components'][$name])) {
            return $this->components->get($name);
        }
        // Если запрашиваемог параметра нет, то возвращаем объект репозитория, если таковой существует.
        return $this->repositories->get($name);
    }

}