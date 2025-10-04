<?php

use PHPUnit\Framework\TestCase;
use Controller\ControllerUserR;
use Model\User;
require_once 'TestTracker.php';

class UserTest extends TestCase
{
    private $userController;
    private $mockUserModel;

    public function setUp(): void
    {
        $this->mockUserModel = $this->createMock(User::class);
        $this->userController = new ControllerUserR($this->mockUserModel);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_create_user()
    {
        $this->mockUserModel->method('registerUser')->willReturn(true);
        
        $userResult = $this->userController->createUser(
            'Reynan Mesquita', 
            'reynanmesquita@gmail.com', 
            '123.456.789-00',
            '123456'
        );

        $this->assertTrue($userResult);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_sign_in()
    {
        $this->mockUserModel->method('getUserByEmail')->willReturn([
            "id" => 1,
            "user_name" => "Reynan Mesquita",
            "user_email" => "reynanmesquita@gmail.com",  
            "password" => password_hash("123456", PASSWORD_DEFAULT)
        ]);

        $userResult = $this->userController->login('reynanmesquita@gmail.com', '123456');

        $this->assertTrue($userResult);
        $this->assertEquals(1, $_SESSION['id']);
        $this->assertEquals('Reynan Mesquita', $_SESSION['user_name']);
        $this->assertEquals('Reynan Mesquita', $_SESSION['user_fullname']);
        $this->assertEquals('reynanmesquita@gmail.com', $_SESSION['user_email']);
        $this->assertEquals('reynanmesquita@gmail.com', $_SESSION['email']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_login_with_invalid_credentials()
    {
        $this->mockUserModel->method('getUserByEmail')->willReturn([
            "id" => 1,
            "user_name" => "Reynan Mesquita",
            "user_email" => "reynanmesquita@gmail.com",
            "password" => password_hash("123456", PASSWORD_DEFAULT)
        ]);

        $userResult = $this->userController->login('reynanmesquita@gmail.com', 'senha_errada');

        $this->assertFalse($userResult);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_check_user_by_email()
    {
        $this->mockUserModel->method('getUserByEmail')->willReturn([
            "id" => 1,
            "user_name" => "Reynan Mesquita",
            "user_email" => "reynanmesquita@gmail.com",
            "password" => password_hash('123456', PASSWORD_DEFAULT)
        ]);

        $userResult = $this->userController->checkUserByEmail('reynanmesquita@gmail.com');

        $this->assertNotNull($userResult);
        $this->assertEquals('reynanmesquita@gmail.com', $userResult['user_email']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_verify_if_is_logged_in()
    {
        $_SESSION['id'] = 1;

        $userResult = $this->userController->isLoggedIn();

        $this->assertTrue($userResult);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_not_create_user_with_empty_fields()
    {
        $result = $this->userController->createUser('', 'reynanmesquita@gmail.com', '123.456.789-00', '123456');
        $this->assertFalse($result);

        $result = $this->userController->createUser('Reynan Mesquita', '', '123.456.789-00', '123456');
        $this->assertFalse($result);

        $result = $this->userController->createUser('Reynan Mesquita', 'reynanmesquita@gmail.com', '', '123456');
        $this->assertFalse($result);

        $result = $this->userController->createUser('Reynan Mesquita', 'reynanmesquita@gmail.com', '123.456.789-00', '');
        $this->assertFalse($result);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_get_first_user()
    {
        $userData = [
            "id" => 1,
            "user_name" => "Reynan Mesquita",
            "user_email" => "reynanmesquita@gmail.com"
        ];

        $this->mockUserModel->method('getFirstUser')->willReturn($userData);

        $result = $this->userController->getFirstUser();
        $this->assertEquals($userData, $result);
    }
}

