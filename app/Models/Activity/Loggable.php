<?php

namespace App\Models\Activity;

interface Loggable
{
    public function logDescriptor(): string;
}
