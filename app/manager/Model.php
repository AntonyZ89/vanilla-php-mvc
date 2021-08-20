<?php

namespace app\manager;

use app\db\Database;
use ReflectionClass;

abstract class Model
{
    /**
     * @var integer
     */
    protected $updated_at;
    /**
     * @var integer
     */
    protected $created_at;

    protected $errors = [];

    public abstract static function tableName(): string;

    public function validate(): bool {
        return true;
    }

    public function load(array $attributes)
    {
        $safe_attributes = array_keys($this->getAttributes());

        foreach ($attributes as $attribute => $value) {
            if (!in_array($attribute, $safe_attributes)) {
                continue;
            }

            $this->{'set' . camelize($attribute)}($value);
        }
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            Controller::setFlash('danger', $this->getErrors());
            return false;
        }

        if ($this->isNewRecord()) {
            $this->created_at = time();
        }

        $this->updated_at = time();

        $db = Database::getInstance();

        $variables = $this->getAttributes();

        $columns = implode(', ', array_keys($variables));
        $params = array_map(static function ($param) {
            return ':' . $param;
        }, array_keys($variables));
        if ($this->isNewRecord()) {
            $result = $db->query(
                sprintf('INSERT into `%s` (%s) VALUES (%s)', static::tableName(), $columns, implode(',', $params)),
                array_combine($params, $variables)
            );
            $this->id = $db->getDb()->lastInsertId();
        } else {

            unset($variables['id']);

            $columns = array_map(static function ($column) {
                return "$column = :$column";
            }, array_keys($variables));

            $params = array_map(static function ($param) {
                return ':' . $param;
            }, array_keys($variables));

            $params = array_merge(
                array_combine($params, array_values($variables)),
                [
                    ':id' => $this->id
                ]
            );

            $result = $db->query(
                sprintf('UPDATE `%s` SET %s WHERE id = :id', static::tableName(), implode(', ', $columns)),
                $params
            );
        }

        return true;
    }

    public function delete()
    {
        $db = Database::getInstance();
        $db->query(
            sprintf('DELETE FROM `%s` WHERE id = :id', static::tableName()),
            [
                ':id' => $this->id
            ]
        );
    }

    public static function  get($conditions = [], $all = false)
    {
        $db = Database::getInstance();

        $columns = array_map(static function ($column) {
            return "$column = :$column";
        }, array_keys($conditions));
        $columns = implode(' AND ', $columns);

        $params = array_map(static function ($param) {
            return ':' . $param;
        }, array_keys($conditions));

        $params = array_combine($params, array_values($conditions));

        $r = $db->select(
            sprintf(
                'SELECT * FROM `%s` %s %s',
                static::tableName(),
                !empty($conditions) ? 'WHERE' : null,
                $columns
            ),
            $params
        );


        if (!empty($r)) {
            if ($all) {
                return array_map(static function ($row) {
                    $model = new static();
                    $model->load($row);
                    return $model;
                }, $r);
            } else {
                $model = new static();
                $model->load(array_shift($r));
                return $model;
            }
        }

        return $all ? [] : null;
    }

    public static function list(): array
    {
        return self::get([], true);
    }

    /**
     * Returns attributes and values
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $variables = [];

        $r = new ReflectionClass($this);

        foreach ($r->getProperties() as $propertie) {
            $name = $propertie->getName();

            $variables[$name] = $this->$name;
        }

        unset($variables['errors']);

        return $variables;
    }

    /**
     * Returns true if Model is a new insert
     *
     * @return boolean
     */
    public function isNewRecord(): bool
    {
        return $this->id === null;
    }

    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return integer|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return integer|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(string $key, string $value): void
    {
        $this->errors[$key] = $value;
    }
}
