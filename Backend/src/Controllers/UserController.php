<?php
    namespace App\Controllers;

    use App\Models\User;
    
    class UserController
    {
        public function register()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
    
                $name = $data['name'];
                $email = $data['email'];
                $password = $data['password'];
    
                $user = new User();
                if ($user->register($name, $email, $password)) {
                    echo json_encode(['message' => 'User registered successfully']);
                } else {
                    echo json_encode(['message' => 'Registration failed']);
                }
            }
        }
    
        public function login()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
    
                $email = $data['email'];
                $password = $data['password'];
    
                $user = new User();
                $authenticatedUser = $user->authenticate($email, $password);
    
                if ($authenticatedUser) {
                    echo json_encode(['message' => 'Login successful', 'user' => $authenticatedUser]);
                } else {
                    echo json_encode(['message' => 'Invalid credentials']);
                }
            }
        }
    }
?>