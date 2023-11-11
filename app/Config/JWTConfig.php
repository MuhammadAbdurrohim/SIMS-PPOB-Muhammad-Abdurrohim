<?php

namespace Config;

class JWTConfig extends \CodeIgniter\Config\BaseConfig
{
    public $jwtKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InVzZXJAbnV0ZWNoLWludGVncmFzaS5jb20iLCJtZW1iZXJDb2RlIjoiTExLUjZKTDEiLCJpYXQiOjE2OTk3MTU2OTcsImV4cCI6MTY5OTc1ODg5N30.VhWoMtKmDRLNGmSKedMYYejbalc0WmpGUdROkL8Vat0';

    public function getJwtKey()
    {
        return $this->jwtKey;
    }

    public function setJwtKey($jwtKey)
    {
        $this->jwtKey = $jwtKey;
    }
}
