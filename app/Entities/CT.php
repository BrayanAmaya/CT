<?php
namespace App\Entities;

use CodeIgniter\Entity;

class CT extends Entity{
    /*Variables de tiempo en la entidad Usuario*/
    protected $dates = ['date_create','date_update','date_delete'];
}