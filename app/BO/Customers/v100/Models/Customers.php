<?php

namespace App\BO\Customers\v100\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customers extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'phone', 'address'
    ];
}