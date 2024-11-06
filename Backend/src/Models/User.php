<?php
    namespace App\Models;

    use App\Database\Database;
    use PDO;
    use Exception;
    
    class User
    {
        private $db;
        private $table = 'users';
    
        public function __construct()
        {
            $this->db = (new Database())->connect();
        }
    
        public function register($name, $email, $password)
        {
            try {
                $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
                return $stmt->execute();
            } catch (Exception $e) {
                return false;
            }
        }
    
        public function authenticate($email, $password)
        {
            try {
                $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
    
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($user && password_verify($password, $user['password'])) {
                    return $user;
                }
    
                return null;
            } catch (Exception $e) {
                return null;
            }
        }
    }
?>