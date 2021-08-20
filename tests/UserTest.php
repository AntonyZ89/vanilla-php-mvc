<?php

namespace tests;

use app\models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require(__DIR__ . '/../config/params.php');
    }

    public function test_create_success()
    {
        $model = new User();

        $model->load([
            'name' => 'Test User',
            'document' => '11211211111',
            'birthday' => '2021-08-20',
            'address' => 'Rua 13 de Maio, SP',
        ]);

        $this->assertEquals('Test User', $model->getName());
        $this->assertEquals('11211211111', $model->getDocument());
        $this->assertEquals('2021-08-20', $model->getBirthday());
        $this->assertEquals('Rua 13 de Maio, SP', $model->getAddress());

        $model->setPassword('123', '123');

        $this->assertTrue($model->save());

    }

    public function test_create_failed()
    {
        $model = new User();

        $model->load([
            'name' => 'Test User',
            'document' => '11211211111',
            'birthday' => '2021-08-20',
            'address' => 'Rua 13 de Maio, SP',
        ]);

        $this->assertEquals('Test User', $model->getName());
        $this->assertEquals('11211211111', $model->getDocument());
        $this->assertEquals('2021-08-20', $model->getBirthday());
        $this->assertEquals('Rua 13 de Maio, SP', $model->getAddress());

        $this->assertFalse($model->save());
    }

    public function test_edit_success()
    {
        $model = User::get(['document' => '11211211111']);

        $this->assertNotNull($model);

        $model->setDocument('11113111113');

        $this->equalTo('11113111113', $model->getDocument());

        $this->assertTrue($model->save());
    }

    public function test_get_success()
    {
        $model = User::get(['document' => '11113111113']);
        $this->assertNotNull($model);
        $this->equalTo('11113111113', $model->getDocument());
    }

    public function test_get_failed()
    {
        $model = User::get(['document' => '11211211111']);
        $this->assertNull($model);
    }

    public function test_edit_failed()
    {
        $model = User::get(['document' => '11113111113']);

        $this->assertNotNull($model);

        $model->setPassword('444', '555');

        $this->assertFalse($model->save());

        $this->assertContains(
            'Senha',
            array_keys($model->getErrors())
        );
    }

    public function test_delete_success()
    {
        $model = User::get(['document' => '11113111113']);
        $model->delete();

        $model = User::get(['document' => '11113111113']);
        $this->assertNull($model);
    }

    public function test_delete_failed()
    {
        $model = User::get(['document' => '11211211111']);
        $this->assertNull($model);

        $this->expectExceptionMessageMatches("/^Call to a member function delete\(\) on null/");
        
        $model->delete();
    }
}
