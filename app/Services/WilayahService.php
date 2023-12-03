<?php

namespace App\Services;

interface WilayahService
{
    public function getAllProvince();
    public function getCitiesByProvince(string $province_id);
}