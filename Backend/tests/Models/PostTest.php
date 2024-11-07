<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Post;
use PHPUnit\Framework\MockObject\MockObject;
use PDOStatement;

class PostTest extends TestCase
{
    private Post $post;
    private MockObject $mockDb;

    protected function setUp(): void
    {
        $this->mockDb = $this->createMock(PDO::class);
        $this->post = new Post();
    }

    public function testCreateSuccess()
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                ->method('execute')
                ->willReturn(true);
        
    
        $this->mockDb->expects($this->once())
                    ->method('prepare')
                    ->willReturn($mockStmt);
        
        $result = $this->post->create(1, 'Post Title', 'Post content', 1);
        $this->assertTrue($result);
    }

    public function testCreateFailure()
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                ->method('execute')
                ->willReturn(false);
        
        $this->mockDb->expects($this->once())
                    ->method('prepare')
                    ->willReturn($mockStmt);
        
        $result = $this->post->create(1, 'Post Title', 'Post content', 1);
        $this->assertFalse($result);
    }

    public function testGetPostsByCategorySuccess()
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                ->method('execute')
                ->willReturn(true);

        $mockStmt->expects($this->once())
                ->method('fetchAll')
                ->willReturn([
                    ['id' => 1, 'user_id' => 1, 'title' => 'Post 1', 'content' => 'Content 1', 'category_id' => 1],
                    ['id' => 2, 'user_id' => 2, 'title' => 'Post 2', 'content' => 'Content 2', 'category_id' => 1],
                ]);
        
        $this->mockDb->expects($this->once())
                    ->method('prepare')
                    ->willReturn($mockStmt);
        
        $result = $this->post->getPostsByCategory(1);
        $this->assertCount(2, $result);
        $this->assertEquals('Post 1', $result[0]['title']);
        $this->assertEquals('Post 2', $result[1]['title']);
    }

    public function testGetPostsByCategoryFailure()
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                ->method('execute')
                ->willReturn(false);

        $this->mockDb->expects($this->once())
                    ->method('prepare')
                    ->willReturn($mockStmt);
        
        $result = $this->post->getPostsByCategory(1);
        $this->assertEmpty($result);
    }
}

?>