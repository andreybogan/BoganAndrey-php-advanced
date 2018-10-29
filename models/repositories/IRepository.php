<?php

namespace app\models\repositories;

use app\models\entity\DataEntity;

/**
 * Interface IRepository
 * @package app\models\repositories
 */
interface IRepository
{
    /** Метод получает из базы данных элемент и возвращает его в виде объекта класса. */
    public function getOne($id);

    /** Метод получает из базы данных массив элементов и возвращает их в виде объекта класса. */
    public function getAll();

    /**
     * Метод удаляет из базы данных информацию о текущем объекте.
     * @param DataEntity $entity - Объект сущности.
     * @return mixed
     */
    public function delete(DataEntity $entity);

    /**
     * Метод вставляет данные текущего объекта в базу данных.
     * @param DataEntity $entity - Объект сущности.
     * @return mixed
     */
    public function insert(DataEntity $entity);

    /**
     * Метод обновляет данные текущего объекта в базе данных.
     * @param DataEntity $entity - Объект сущности.
     * @return mixed
     */
    public function update(DataEntity $entity);

    /**
     * Метод определяет какую операцию нужно запустить для объекта: insert или update.
     * @param DataEntity $entity - Объект сущности.
     * @return mixed
     */
    public function save(DataEntity $entity);

    /**
     * Метод возвращает класс сущности с которой будет работать Repository.
     * @return string
     */
    public function getEntityClass();

    /** Метод возвращает название таблицы в базе данных для текущего класса. */
    public function getTableName();
}