<?php
    namespace App\Models;

    use App\Database\Database;
    use PDO;
    use Exception;
    
    class Post
    {
        private $db;
        private $table = 'posts';
    
        public function __construct()
        {
            $this->db = (new Database())->connect();
        }
    
        public function create($userId, $title, $content)
        {
            try {
                $stmt = $this->db->prepare("INSERT INTO {$this->table} (user_id, title, content) VALUES (:user_id, :title, :content)");
                $stmt->bindParam(':user_id', $userId);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);
                return $stmt->execute();
            } catch (Exception $e) {
                return false;
            }
        }
    
        public function getPostsByCategory($categoryId)
        {
            try {
                $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE category_id = :category_id");
                $stmt->bindParam(':category_id', $categoryId);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return [];
            }
        }
    }
?>