<?php

namespace MarkRassamni\NovaResourceLandingPage\Contracts;

interface ResourceLandingPageInterface
{

    /**
     * @return string|int
     */
    public static function recordId();

    public static function detail(): bool;

    public static function create(): bool;

    public static function edit(): bool;

}
