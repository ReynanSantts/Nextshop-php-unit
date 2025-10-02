<?php

use PHPUnit\Framework\TestCase;
use Controller\ControllerUserR;
use Model\User;

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
}