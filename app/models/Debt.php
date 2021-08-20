<?php

namespace app\models;

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
     * @var string
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

    public function validate(): bool
    {
        if (!strlen($this->description)) {
            $this->setErrors('Descrição', '"Descrição" é um campo obrigatório.');
        }

        if (empty($this->value) || !is_numeric($this->value)) {
            $this->setErrors('Valor', '"Valor" é um campo obrigatório.');
        }

        if (empty($this->user_id)) {
            $this->setErrors('Usuário', 'Informe um ID válido do usuário.');
        }

        if (!is_date_valid($this->due_date)) {
            $this->setErrors('Data de vencimento', 'Insira uma "Data de vencimento" válida.');
        }

        return empty($this->getErrors());
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function setDescription($description): void
    {
        $this->description = trim($description);
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
