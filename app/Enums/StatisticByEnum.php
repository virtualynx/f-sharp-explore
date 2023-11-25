<?php
namespace App\Enums;

enum StatisticByEnum : string
{
    case OPERATOR = 'operator';
    case HANDSET = 'phone';
    case GENDER = 'gender';
    case GENERATION = 'generation';
    case RELIGION = 'religion';
    case OCCUPATION = 'occupation';
    case EDUCATION = 'education';
    case PROVINCE = 'province';
    case CITY = 'city';
    case DISTRICT = 'district';
}