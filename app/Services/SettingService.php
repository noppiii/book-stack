<?php

namespace App\Services;

/**
 * Class SettingService
 * The settings are a simple key-value database store.
 * For non-authenticated users, user settings are stored via the session instead.
 * A local array-based cache is used to for setting accesses across a request.
 */
class SettingService
{
    protected array $localeCache = [];
}
