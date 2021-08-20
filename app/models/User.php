<?php

namespace app\models;

use app\manager\Controller;
use app\manager\Model;
use Exception;

class User extends Model
{

    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $document;
    /**
     * @var string
     */
    protected $birthday;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var string
     */
    protected $password_hash;

    public function validate(): bool
    {
        $length = strlen($this->document);
        if ($length !==  11 && $length !== 14) {
            $this->setErrors('CPF/CNPJ', 'Insira um CPF ou CNPJ válido.');
        }

        if (empty($this->birthday)) {
            $this->setErrors('Data de nascimento', 'Insira uma data de Nascimento válida');
        }

        if (empty($this->address)) {
            $this->setErrors('Endereço', 'Insira um endereço válido');
        }

        return empty($this->getErrors());
    }

    /**
     * Set password_hash
     *
     * @param string $password
     * @param string $confirmPassword
     * @return void
     */
    public function setPassword(string $password, string $confirmPassword): void
    {
        if ($password !== $confirmPassword) {
            $this->setErrors('password', 'Senhas diferentes');
        } else {
            $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->password_hash);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument(string $document): void
    {
        $this->document = $document;
    }

    /**
     * @return string|null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}
