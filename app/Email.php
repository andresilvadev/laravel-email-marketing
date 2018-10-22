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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
}
