<?php

namespace App\Core;

interface Sluggable
{

    public function refreshSlug(): string;
}

