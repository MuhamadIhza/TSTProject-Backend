<?php namespace App\Models;

use CodeIgniter\Model;

class Modelmahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nim','nama','alamat','nohp','email','indeks'];
}

