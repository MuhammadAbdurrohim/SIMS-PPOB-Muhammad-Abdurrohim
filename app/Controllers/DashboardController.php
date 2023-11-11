<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\AuthController;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

use \Firebase\JWT\JWT;

class DashboardController extends BaseController
{
    use ResponseTrait;

    private function getJwtKey()
    {
        // Create an instance of AuthController
        $authController = new AuthController();

        // Call the getJwtKey method on AuthController
        return $authController->getJwtKey();
    }

    public function index()
    {
        // Get the JWT key dynamically from AuthController
        $jwtKey = $this->getJwtKey();

        // Set up cURL options
        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Authorization: Bearer ' . $jwtKey,
            ],
        ];

        // Initialize cURL
        $ch = curl_init();

        // Fetch profile data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/profile');
        curl_setopt_array($ch, $curlOptions);
        $profileData = json_decode(curl_exec($ch), true);

        // Fetch balance data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/balance');
        curl_setopt_array($ch, $curlOptions);
        $balanceData = json_decode(curl_exec($ch), true);

        // Fetch data from the services API
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/services');
        curl_setopt_array($ch, $curlOptions);
        $servicesData = json_decode(curl_exec($ch), true);

        // Fetch data from the banner API
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/banner');
        curl_setopt_array($ch, $curlOptions);
        $bannerData = json_decode(curl_exec($ch), true);

        // Close cURL
        curl_close($ch);
        
        return view('dashboard', [
            'profileData' => $profileData,
            'balanceData' => $balanceData,
            'servicesData'=> $servicesData,
            'bannerData'  => $bannerData
        ]);        
    }

    public function isitopup()
    {
        // Get the JWT key dynamically from AuthController
        $jwtKey = $this->getJwtKey();

        // Set up cURL options
        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Authorization: Bearer ' . $jwtKey,
            ],
        ];

        // Initialize cURL
        $ch = curl_init();

        // Fetch profile data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/profile');
        curl_setopt_array($ch, $curlOptions);
        $profileData = json_decode(curl_exec($ch), true);

        // Fetch balance data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/balance');
        curl_setopt_array($ch, $curlOptions);
        $balanceData = json_decode(curl_exec($ch), true);

        // Close cURL
        curl_close($ch);
        
        return view('feature/topup', [
            'profileData' => $profileData,
            'balanceData' => $balanceData
        ]);
    }

    public function bayarin()
    {
        // Get the JWT key dynamically from AuthController
        $jwtKey = $this->getJwtKey();

        // Set up cURL options
        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Authorization: Bearer ' . $jwtKey,
            ],
        ];

        // Initialize cURL
        $ch = curl_init();

        // Fetch profile data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/profile');
        curl_setopt_array($ch, $curlOptions);
        $profileData = json_decode(curl_exec($ch), true);

        // Fetch balance data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/balance');
        curl_setopt_array($ch, $curlOptions);
        $balanceData = json_decode(curl_exec($ch), true);

        // Fetch data from the services API
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/services');
        curl_setopt_array($ch, $curlOptions);
        $servicesData = json_decode(curl_exec($ch), true);
        
        // Close cURL
        curl_close($ch);
        
        return view('feature/bayar', [
            'profileData' => $profileData,
            'servicesData' => $servicesData,
            'balanceData' => $balanceData
        ]);
    }

    public function transaksi()
    {
        // Get the JWT key dynamically from AuthController
        $jwtKey = $this->getJwtKey();

        // Set up cURL options
        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Authorization: Bearer ' . $jwtKey,
            ],
        ];

        // Initialize cURL
        $ch = curl_init();

        // Fetch profile data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/profile');
        curl_setopt_array($ch, $curlOptions);
        $profileData = json_decode(curl_exec($ch), true);

        // Fetch balance data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/balance');
        curl_setopt_array($ch, $curlOptions);
        $balanceData = json_decode(curl_exec($ch), true);

        // Fetch data from the services API
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/transaction/history?offset=0&limit=5');
        curl_setopt_array($ch, $curlOptions);
        $historyData = json_decode(curl_exec($ch), true);
        
        // Close cURL
        curl_close($ch);
        
        return view('feature/transaksi', [
            'profileData' => $profileData,
            'balanceData' => $balanceData,
            'historyData' => $historyData
        ]);
    }

    public function akun()
    {
        // Get the JWT key dynamically from AuthController
        $jwtKey = $this->getJwtKey();

        // Set up cURL options
        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Authorization: Bearer ' . $jwtKey,
            ],
        ];

        // Initialize cURL
        $ch = curl_init();

        // Fetch profile data
        curl_setopt($ch, CURLOPT_URL, 'https://take-home-test-api.nutech-integrasi.app/profile');
        curl_setopt_array($ch, $curlOptions);
        $profileData = json_decode(curl_exec($ch), true);
        
        // Close cURL
        curl_close($ch);
        
        return view('feature/akun', [
            'profileData' => $profileData
        ]);
    }
}