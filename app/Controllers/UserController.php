<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use App\Models\Category;

class UserController
{
    // Formular de autentificare
    public function login(Request $request, Response $response)
    {
        ob_start();
        require_once '../views/users/login.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Autentificare utilizator
    public function authenticate(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $email = trim($data['email']);
        $password = $data['password'];

        $user = User::where('email', $email)->first();
        
        if ($user && password_verify($password, $user->password)) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = htmlspecialchars($user->name);

            return $response->withHeader('Location', '/profile')->withStatus(302);
        } else {
            $_SESSION['error'] = 'Email sau parolă incorectă';
            return $response->withHeader('Location', '/login')->withStatus(302);
        }
    }

    // Formular de înregistrare
    public function register(Request $request, Response $response)
    {
        ob_start();
        require_once '../views/users/register.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Înregistrare utilizator nou
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        // Validare email unic
        if (User::where('email', $data['email'])->exists()) {
            $_SESSION['error'] = 'Adresa de email este deja utilizată.';
            return $response->withHeader('Location', '/register')->withStatus(302);
        }

        $user = new User();
        $user->name = htmlspecialchars($data['name']);
        $user->email = htmlspecialchars($data['email']);
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->save();

        return $response->withHeader('Location', '/login')->withStatus(302);
    }

    // Afișare profil utilizator
    public function profile(Request $request, Response $response)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $user = User::find($_SESSION['user_id']);
        ob_start();
        require_once '../views/users/profile.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Formular pentru resetare parolă
    public function editPassword(Request $request, Response $response)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        ob_start();
        require_once '../views/users/edit_password.view.php'; // Formular pentru resetarea parolei
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Resetare parolă
    public function updatePassword(Request $request, Response $response)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $data = $request->getParsedBody();
        $user = User::find($_SESSION['user_id']);

        $newPassword = $data['password'];
        $confirmPassword = $data['password_confirmation'];

        // Verificăm dacă parolele sunt identice
        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = 'Parolele nu se potrivesc!';
            return $response->withHeader('Location', '/editPassword')->withStatus(302);
        }

        if (!empty($data['password'])) {
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->save();
            $_SESSION['success'] = 'Parola a fost actualizată cu succes.';
        } else {
            $_SESSION['error'] = 'Parola nu poate fi goală.';
        }

        return $response->withHeader('Location', '/profile')->withStatus(302);
    }

    public function navbar(Request $request, Response $response)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $isLoggedIn = isset($_SESSION['user_id']); // Verifică dacă utilizatorul este conectat
        $userName = $isLoggedIn ? $_SESSION['user_name'] : null; // Numele utilizatorului (opțional)
    
        // Preia categoriile
        $categories = Category::all();
        var_dump($categories); // Adaugă acest var_dump pentru debugging
        die(); // Opriți execuția pentru a verifica ce se întâmplă

        // Dacă sunt categoriile disponibile, le trimitem în view
        ob_start();
        require_once '../views/users/nav.view.php'; // Trimite datele la view
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Deconectare utilizator
    public function logout(Request $request, Response $response)
    {
        session_start();
        session_destroy();
        return $response->withHeader('Location', '/login')->withStatus(302);
    }
}
