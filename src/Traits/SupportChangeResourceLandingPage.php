<?php

namespace MarkRassamni\NovaResourceLandingPage\Traits;

trait SupportChangeResourceLandingPage
{
    /**
     * @return string|int
     */
    public static function recordId()
    {
        return 1;
    }

    public static function detail(): bool
    {
        return false;
    }

    public static function create(): bool
    {
        return false;
    }

    public static function edit(): bool
    {
        return false;
    }
}
