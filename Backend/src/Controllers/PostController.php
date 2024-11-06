<?php
    namespace App\Controllers;

    use App\Models\Post;
    
    class PostController
    {
        public function createPost()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $userId = $data['user_id'];
                $title = $data['title'];
                $content = $data['content'];
    
                $post = new Post();
                if ($post->create($userId, $title, $content)) {
                    echo json_encode(['message' => 'Post created successfully']);
                } else {
                    echo json_encode(['message' => 'Failed to create post']);
                }
            }
        }
    
        public function getPostsByCategory($categoryId)
        {
            $post = new Post();
            $posts = $post->getPostsByCategory($categoryId);
            echo json_encode($posts);
        }
    }
?>