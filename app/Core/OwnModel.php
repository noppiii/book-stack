<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class OwnModel extends EloquentModel
{
    // Provides public access to get the raw attribute value from the model. Used in areas where no mutations are required but performance is critical.
    public function getRawAttribute(string $key)
    {
        return parent::getAttributeFromArray($key);
    }
}
