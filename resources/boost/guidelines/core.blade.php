## fabianpankoke/mobile-device-timezone

Reads the device's current IANA timezone identifier (e.g. `Europe/Vienna`) from a NativePHP Mobile app.

### Installation

```bash
composer require fabianpankoke/mobile-device-timezone
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register fabianpankoke/mobile-device-timezone
php artisan native:plugin:list
```

### PHP Usage

@verbatim
<code-snippet name="Using DeviceTimezone Facade" lang="php">
use FabianPankoke\MobileDeviceTimezone\Facades\DeviceTimezone;

$identifier = DeviceTimezone::get(); // e.g. "Europe/Vienna", or null off-device

if ($identifier !== null) {
    $localNow = now($identifier);
}
</code-snippet>
@endverbatim

### Notes

- Synchronous — no event/callback round trip.
- Returns `null` when the native bridge isn't available (tests, tinker, plain `php artisan serve`).
- No permissions required on either platform.
