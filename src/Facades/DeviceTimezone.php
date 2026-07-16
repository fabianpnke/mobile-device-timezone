<?php

namespace FabianPankoke\MobileDeviceTimezone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|null get()
 *
 * @see \FabianPankoke\MobileDeviceTimezone\DeviceTimezone
 */
class DeviceTimezone extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \FabianPankoke\MobileDeviceTimezone\DeviceTimezone::class;
    }
}
