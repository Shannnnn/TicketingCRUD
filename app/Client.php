<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;
use DB;

class Client extends Model
{

    public $fillable = ['company_name','branch','address'];

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

}
