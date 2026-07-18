## fabianpnke/mobile-device-timezone

Reads the device's current IANA timezone identifier (e.g. `Europe/Vienna`) from a NativePHP Mobile app.

### Installation

```bash
composer require fabianpnke/mobile-device-timezone
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register fabianpnke/mobile-device-timezone
php artisan native:plugin:list
```

### PHP Usage

@verbatim
<code-snippet name="Using DeviceTimezone Facade" lang="php">
use Fabianpnke\MobileDeviceTimezone\Facades\DeviceTimezone;

$identifier = DeviceTimezone::get(); // e.g. "Europe/Vienna", or null off-device

if ($identifier !== null) {
    $localNow = now($identifier);
}
</code-snippet>
@endverbatim

### JavaScript Usage (Vue/React/Inertia)

@verbatim
<code-snippet name="Using DeviceTimezone in JavaScript" lang="javascript">
import { DeviceTimezone } from '@fabianpnke/mobile-device-timezone';

const identifier = await DeviceTimezone.get(); // e.g. "Europe/Vienna", or null
</code-snippet>
@endverbatim

### Notes

- Synchronous on the PHP side — no event/callback round trip. The JS call is a `fetch()`, so it's `async`/returns a Promise.
- Returns `null` when the native bridge isn't available (tests, tinker, plain `php artisan serve`), or on the rare platform edge case where the OS can't resolve one.
- No permissions required on either platform.
