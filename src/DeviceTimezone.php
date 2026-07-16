<?php

namespace FabianPankoke\MobileDeviceTimezone;

class DeviceTimezone
{
    /**
     * The device's current IANA timezone identifier (e.g. "Europe/Vienna"),
     * or null when the native bridge isn't available (tests, tinker, plain
     * `php artisan serve`) or the platform couldn't resolve one.
     */
    public function get(): ?string
    {
        if (! function_exists('nativephp_call')) {
            return null;
        }

        $result = nativephp_call('DeviceTimezone.Get', '{}');

        if (! $result) {
            return null;
        }

        $decoded = json_decode($result, true);

        return $decoded['identifier'] ?? null;
    }
}
