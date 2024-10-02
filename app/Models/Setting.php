<?php

namespace App\Models;

use App\Core\OwnModel;

class Setting extends OwnModel
{
    protected $fillable = ['setting_key', 'value'];

    protected $primaryKey = 'setting_key';
}
