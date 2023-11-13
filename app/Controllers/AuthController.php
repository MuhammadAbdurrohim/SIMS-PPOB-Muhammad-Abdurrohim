<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

use Config\JWTConfig;
use \Config\Services;
use \Firebase\JWT\JWT;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    use ResponseTrait;

    public $jwtConfig; 

    public function __construct()
    {
        // Create an instance of JWTConfig
        $this->jwtConfig = new JWTConfig(); 
    }

    public function getJwtKey()
    {
        return $this->jwtConfig->jwtKey;
    }

    public function generateJwt($email)
    {
        // Access the jwtKey property
        $key = $this->jwtConfig->jwtKey;

        $expiration = time() + 60 * 60 * 12; // 12 hours

        $payload = [
            'email' => $email,
            'exp' => $expiration,
        ];

        // Explicitly pass the algorithm as the third argument
        $jwtToken = JWT::encode($payload, $key, 'HS256');

        // Log or echo the JWT token
        log_message('info', 'Generated JWT token: ' . $jwtToken);

        return $jwtToken;
    }

    public function login()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ], [
            'email' => [
                'valid_email' => 'Please enter a valid email address.',
            ],
            'password' => [
                'min_length' => 'Password must be at least 8 characters long.',
            ],
        ]);

        if (!$validation->run($this->request->getPost())) {
            log_message('error', 'Validation failed during login: ' . print_r($validation->getErrors(), true));

            // Set flashdata for validation errors
            session()->setFlashdata('validation_errors', $validation->getErrors());

            return redirect()->to('login')->withInput();
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $curl = \Config\Services::curlrequest();

        $data = [
            'email'    => $email,
            'password' => $password,
        ];

        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_URL => 'https://take-home-test-api.nutech-integrasi.app/login',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);
        $response = json_decode(curl_exec($ch), true);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $jwtToken = $this->generateJwt($email);

            // Save the JWT token to the session or any storage
            session()->set('jwt_token', $jwtToken);

            // Update JWTConfig with the new JWT key
            $this->jwtConfig->setJwtKey($jwtToken);

            // Redirect or perform any action after successful login
            return redirect()->to('dashboard');
        } else {
            // Handle other response codes or errors
            $errorMessage = isset($response['message']) ? $response['message'] : 'Unknown error';
            log_message('error', 'Login failed: ' . $errorMessage);

            // Set flashdata for error message
            session()->setFlashdata('error_message', $errorMessage);

            return redirect()->to('login')->withInput();
        }
    }

    public function register()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email'      => 'required|valid_email',
            'first_name' => 'required',
            'last_name'  => 'required',
            'password'   => 'required|min_length[8]',
        ],[
            'email' => [
                'valid_email' => 'Please enter a valid email address.',
            ],
            'first_name' => [
                'required' => 'Please enter a first name.',
            ],
            'last_name' => [
                'required' => 'Please enter a last name.',
            ],
            'password' => [
                'min_length' => 'Password must be at least 8 characters long.',
            ],
        ]);

        if (!$validation->run($this->request->getPost())) {
            log_message('error', 'Validation failed during registration: ' . print_r($validation->getErrors(), true));

            // Set flashdata for validation errors
            session()->setFlashdata('validation_errors', $validation->getErrors());

            return redirect()->to('register')->withInput();
        }

        $email      = $this->request->getPost('email');
        $first_name = $this->request->getPost('first_name');
        $last_name  = $this->request->getPost('last_name');
        $password   = $this->request->getPost('password');

        $curl = \Config\Services::curlrequest();

        $data = [
            'email'    => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'password' => $password,
        ];

        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_URL => 'https://take-home-test-api.nutech-integrasi.app/registration',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);
        $response = json_decode(curl_exec($ch), true);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Log HTTP status code for debugging
        log_message('info', 'HTTP status code: ' . $httpCode);

        // Check the HTTP status code
        if ($httpCode === 200) {
            // Redirect to login if registration is successful
            return redirect()->to('login')->with('success_message', 'Registration successful. Please login.');
        } else {
            // Show error message if registration fails
            $errorMessage = isset($response['message']) ? $response['message'] : 'Unknown error';
            log_message('error', 'Registration failed: ' . $errorMessage);

            // Set flashdata for error message
            session()->setFlashdata('error_message', $errorMessage);

            return redirect()->to('register')->withInput();
        }
    }

    public function index()
    {
        return view('auth/login');
    }

    public function displaylogin()
    {
        return view('auth/login');
    }

    public function displayregister()
    {
        return view('auth/registration');
    }
}