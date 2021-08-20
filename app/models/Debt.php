<?php

namespace app\models;

use app\db\Database;
use app\manager\Model;

class Debt extends Model
{

    public static function tableName(): string
    {
        return 'debt';
    }

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float IMPORTANT verificar se vem em float mesmo!
     */
    protected $value;

    /**
     * @var integer
     */
    protected $user_id;

    /**
     * @var string
     */
    protected $due_date;

    public function validate(): bool {
        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return float|null
     */
    public function getValue()
    {
        return $this->value;
    }

    public function setDueDate($due_date): void
    {
        $this->due_date = $due_date;
    }

    /**
     * @return string|null
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return integer|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * QUERIES
     */

    public static function listByUser(int $user_id): array
    {
        return self::get(['user_id' => $user_id], true);
    }
}
