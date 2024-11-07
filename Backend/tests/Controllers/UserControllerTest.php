<?php

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\UserController;
use App\Models\User;
use PHPUnit\Framework\MockObject\MockObject;

class UserControllerTest extends TestCase
{
    private UserController $controller;
    private MockObject $mockUser;

    protected function setUp(): void
    {
        $this->controller = new UserController();

    
        $this->mockUser = $this->createMock(User::class);
    }

    public function testRegisterSuccess()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $data = json_encode(['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password123']);
        file_put_contents('php://input', $data);

        $this->mockUser->expects($this->once())
                    ->method('register')
                    ->with('John Doe', 'john@example.com', 'password123')
                    ->willReturn(true);

        $this->controller->register();

        $output = ob_get_clean();

        $this->assertStringContainsString('User registered successfully', $output);
    }

    public function testRegisterFailure()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $data = json_encode(['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password123']);
        file_put_contents('php://input', $data);

        $this->mockUser->expects($this->once())
                    ->method('register')
                    ->with('John Doe', 'john@example.com', 'password123')
                    ->willReturn(false);

        $this->controller->register();

        $output = ob_get_clean();

        $this->assertStringContainsString('Registration failed', $output);
    }

    public function testLoginSuccess()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $data = json_encode(['email' => 'john@example.com', 'password' => 'password123']);
        file_put_contents('php://input', $data);

        $this->mockUser->expects($this->once())
                    ->method('authenticate')
                    ->with('john@example.com', 'password123')
                    ->willReturn([
                        'id' => 1,
                        'name' => 'John Doe',
                        'email' => 'john@example.com',
                    ]);

        $this->controller->login();

        $output = ob_get_clean();

        $this->assertStringContainsString('Login successful', $output);
        $this->assertStringContainsString('john@example.com', $output);
    }

    public function testLoginFailure()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $data = json_encode(['email' => 'john@example.com', 'password' => 'wrongpassword']);
        file_put_contents('php://input', $data);

        $this->mockUser->expects($this->once())
                    ->method('authenticate')
                    ->with('john@example.com', 'wrongpassword')
                    ->willReturn(null);

        $this->controller->login();

        $output = ob_get_clean();

        $this->assertStringContainsString('Invalid credentials', $output);
    }
}

?>