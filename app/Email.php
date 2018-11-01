<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\Group;
use Mail;
use App\Transaction;

class Email extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'subject',
        'body',
        'image'
    ];

}
