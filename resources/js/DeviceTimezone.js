/**
 * DeviceTimezone Plugin for NativePHP Mobile
 *
 * @example
 * import { DeviceTimezone } from '@fabianpankoke/mobile-device-timezone';
 *
 * const identifier = await DeviceTimezone.get(); // e.g. "Europe/Vienna", or null off-device
 */

const baseUrl = '/_native/api/call';

async function bridgeCall(method, params = {}) {
    const response = await fetch(baseUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ method, params })
    });

    const result = await response.json();

    if (result.status === 'error') {
        throw new Error(result.message || 'Native call failed');
    }

    const nativeResponse = result.data;
    if (nativeResponse && nativeResponse.data !== undefined) {
        return nativeResponse.data;
    }

    return nativeResponse;
}

/**
 * The device's current IANA timezone identifier (e.g. "Europe/Vienna"),
 * or null when the platform couldn't resolve one.
 */
async function get() {
    const result = await bridgeCall('DeviceTimezone.Get');
    return result?.identifier ?? null;
}

export const DeviceTimezone = {
    get,
};

export default DeviceTimezone;
