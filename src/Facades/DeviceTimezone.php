<?php

namespace Fabianpnke\MobileDeviceTimezone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|null get()
 *
 * @see \Fabianpnke\MobileDeviceTimezone\DeviceTimezone
 */
class DeviceTimezone extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Fabianpnke\MobileDeviceTimezone\DeviceTimezone::class;
    }
}
