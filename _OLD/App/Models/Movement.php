<?php


namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;


class Movement extends DataLayer
{
    public function __construct()
    {
        parent::__construct("movement", []);
    }
}