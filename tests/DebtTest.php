<?php

namespace tests;

use app\models\Debt;
use app\models\User;
use PHPUnit\Framework\TestCase;

class DebtTest extends TestCase
{
    public $user_id, $debt_id;

    public static function setUpBeforeClass(): void
    {
        require(__DIR__ . '/../config/params.php');

        $model = new User();

        $model->load([
            'name' => 'Test User',
            'document' => '22223223222',
            'birthday' => '2021-08-20',
            'address' => 'Rua 13 de Maio, SP',
        ]);

        $model->setPassword('123', '123');
        $model->save();
    }

    public function test_create_success()
    {
        $model = new Debt();

        $user = User::get(['document' => '22223223222']);
        $this->assertNotNull($user);

        $model->load([
            'description' => 'Lorem ipsum',
            'value' => '250.06',
            'user_id' => $user->getId(),
            'due_date' => '2021-08-21',
        ]);

        $this->assertEquals('Lorem ipsum', $model->getDescription());
        $this->assertEquals('250.06', $model->getValue());
        $this->assertEquals($user->getId(), $model->getUserId());
        $this->assertEquals('2021-08-21', $model->getDueDate());

        $this->assertTrue($model->save());
    }

    public function test_create_failed()
    {
        $model = new Debt();

        $user = User::get(['document' => '22223223222']);
        $this->assertNotNull($user);

        $model->load([
            'description' => 'Lorem ipsum',
            'value' => 'abc',
            'user_id' => $user->getId(),
            'due_date' => '2021-08-21',
        ]);

        $this->assertFalse($model->save());
        $this->assertContains(
            'Valor',
            array_keys($model->getErrors())
        );
    }

    public function test_edit_success()
    {
        $user = User::get(['document' => '22223223222']);

        $this->assertNotNull($user);

        $model = Debt::get(['user_id' => $user->getId()]);

        $this->assertNotNull($model);

        $model->setDueDate('2022-01-01');

        $this->equalTo('2022-01-01', $model->getDueDate());

        $this->assertTrue($model->save());
    }

    public function test_get_success()
    {
        $user = User::get(['document' => '22223223222']);

        $this->assertNotNull($user);

        $model = Debt::get(['user_id' => $user->getId()]);
        $this->assertNotNull($model);
        $this->equalTo($this->debt_id, $model->getId());
    }

    public function test_get_failed()
    {
        $model = Debt::get(['id' => '999']);
        $this->assertNull($model);
    }

    public function test_edit_failed()
    {
        $user = User::get(['document' => '22223223222']);

        $this->assertNotNull($user);

        $model = Debt::get(['user_id' => $user->getId()]);

        $this->assertNotNull($model);

        $model->setDueDate('01/01/2020');

        $this->assertFalse($model->save());

        $this->assertContains(
            'Data de vencimento',
            array_keys($model->getErrors())
        );
    }

    public function test_delete_success()
    {
        $user = User::get(['document' => '22223223222']);

        $this->assertNotNull($user);

        $model = Debt::get(['user_id' => $user->getId()]);
        $model->delete();
        
        $model = Debt::get(['user_id' => $user->getId()]);
        $this->assertNull($model);
    }

    public function test_delete_failed()
    {
        $user = User::get(['document' => '22223223222']);

        $this->assertNotNull($user);

        $model = Debt::get(['user_id' => $user->getId()]);
        $this->assertNull($model);

        $this->expectExceptionMessageMatches("/^Call to a member function delete\(\) on null/");

        $model->delete();
    }

    public static function tearDownAfterClass(): void
    {
        $model = User::get(['document' => '22223223222']);

        if ($model) {
            $model->delete();
        }
    }
}
