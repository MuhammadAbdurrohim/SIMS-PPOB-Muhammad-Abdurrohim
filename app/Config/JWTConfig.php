<?php

namespace Config;

class JWTConfig extends \CodeIgniter\Config\BaseConfig
{
    public $jwtKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InVzZXJAbnV0ZWNoLWludGVncmFzaS5jb20iLCJtZW1iZXJDb2RlIjoiTExLUjZKTDEiLCJpYXQiOjE2OTk4NjgzMTEsImV4cCI6MTY5OTkxMTUxMX0.ouM93zG934Ex-Of_F0XRxowUnTgoxYonzAALO0Zzj-8';

    public function getJwtKey()
    {
        return $this->jwtKey;
    }

    public function setJwtKey($jwtKey)
    {
        $this->jwtKey = $jwtKey;
    }
}
