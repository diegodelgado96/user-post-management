<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Database\Database;

class UserTest extends TestCase
{
    private $user;
    private $dbMock;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(Database::class);
        $this->user = new User($this->dbMock);
    }

    public function testRegisterSuccess()
    {
        $stmtMock = $this->createMock(PDO::class);

        $this->dbMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->assertTrue($this->user->register('Test User', 'test@example.com', 'password'));
    }

    public function testRegisterFailure()
    {
        $this->dbMock->expects($this->once())
            ->method('prepare')
            ->willReturn($this->createMock(PDO::class));

        $this->dbMock->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        $this->assertFalse($this->user->register('Test User', 'test@example.com', 'password'));
    }

    public function testAuthenticateSuccess()
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                ->method('execute')
                ->willReturn(true);

        $mockStmt->expects($this->once())
                ->method('fetch')
                ->willReturn(['email' => 'john@example.com', 'password' => password_hash('password123', PASSWORD_BCRYPT)]);

        $this->mockDb->expects($this->once())
                    ->method('prepare')
                    ->willReturn($mockStmt);

        $result = $this->user->authenticate('john@example.com', 'password123');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('email', $result);
    }

    public function testAuthenticateFailure()
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                ->method('execute')
                ->willReturn(true);

        $mockStmt->expects($this->once())
                ->method('fetch')
                ->willReturn(false);  

        $this->mockDb->expects($this->once())
                    ->method('prepare')
                    ->willReturn($mockStmt);

        $result = $this->user->authenticate('john@example.com', 'password123');
        $this->assertNull($result);
    }
}