# Device Timezone Plugin for NativePHP Mobile

Reads the device's current IANA timezone identifier (e.g. `Europe/Vienna`) from a NativePHP Mobile app — the one piece of device info NativePHP core doesn't expose yet.

## Installation

```bash
composer require fabianpnke/mobile-device-timezone
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register fabianpnke/mobile-device-timezone
php artisan native:plugin:list
```

This adds `\Fabianpnke\MobileDeviceTimezone\DeviceTimezoneServiceProvider::class` to your `plugins()` array. Rebuild the app (`native:run`) afterwards.

## Usage

```php
use Fabianpnke\MobileDeviceTimezone\Facades\DeviceTimezone;

$identifier = DeviceTimezone::get(); // e.g. "Europe/Vienna"

if ($identifier !== null) {
    $localNow = now($identifier);
}
```

`get()` returns `null` when the native bridge isn't available — off-device (tests, `php artisan tinker`, plain `php artisan serve`), or on the rare platform edge case where the OS can't resolve one.

### JavaScript (Vue/React/Inertia)

```javascript
import { DeviceTimezone } from '@fabianpnke/mobile-device-timezone';

const identifier = await DeviceTimezone.get(); // e.g. "Europe/Vienna", or null
```

## Platform Notes

| Platform | Source |
|---|---|
| iOS | `TimeZone.current.identifier` |
| Android | `TimeZone.getDefault().id` |

No permissions required on either platform.

## Compatibility

Requires `nativephp/mobile` `^3.2.1` or `^4.0`.

## License

MIT
