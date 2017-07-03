<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{

    public $fillable = ['contact_name','contact_number','email','label'];

}
