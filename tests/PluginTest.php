<?php

use FabianPankoke\MobileDeviceTimezone\DeviceTimezone;

beforeEach(function () {
    $this->pluginPath = dirname(__DIR__);
    $this->manifestPath = $this->pluginPath.'/nativephp.json';
});

describe('Plugin Manifest', function () {
    it('has a valid nativephp.json file', function () {
        expect(file_exists($this->manifestPath))->toBeTrue();

        $content = file_get_contents($this->manifestPath);
        json_decode($content, true);

        expect(json_last_error())->toBe(JSON_ERROR_NONE);
    });

    it('has required fields', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest)->toHaveKeys(['namespace', 'bridge_functions']);
    });

    it('has a valid Get bridge function declared for both platforms', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['bridge_functions'])->toHaveCount(1);

        $function = $manifest['bridge_functions'][0];

        expect($function['name'])->toBe('DeviceTimezone.Get');
        expect($function)->toHaveKeys(['android', 'ios']);
    });
});

describe('Native Code', function () {
    it('has Android Kotlin file', function () {
        expect(file_exists($this->pluginPath.'/resources/android/DeviceTimezoneFunctions.kt'))->toBeTrue();
    });

    it('has iOS Swift file', function () {
        expect(file_exists($this->pluginPath.'/resources/ios/DeviceTimezoneFunctions.swift'))->toBeTrue();
    });

    it('has a JavaScript module', function () {
        expect(file_exists($this->pluginPath.'/resources/js/DeviceTimezone.js'))->toBeTrue();
    });
});

describe('PHP Classes', function () {
    it('has service provider', function () {
        expect(file_exists($this->pluginPath.'/src/DeviceTimezoneServiceProvider.php'))->toBeTrue();
    });

    it('has facade', function () {
        expect(file_exists($this->pluginPath.'/src/Facades/DeviceTimezone.php'))->toBeTrue();
    });

    it('has main implementation class', function () {
        expect(file_exists($this->pluginPath.'/src/DeviceTimezone.php'))->toBeTrue();
    });
});

describe('Composer Configuration', function () {
    it('has valid composer.json', function () {
        $composerPath = $this->pluginPath.'/composer.json';
        expect(file_exists($composerPath))->toBeTrue();

        $composer = json_decode(file_get_contents($composerPath), true);

        expect(json_last_error())->toBe(JSON_ERROR_NONE);
        expect($composer['type'])->toBe('nativephp-plugin');
    });
});

describe('DeviceTimezone', function () {
    it('returns null when the native bridge is unavailable', function () {
        expect(function_exists('nativephp_call'))->toBeFalse();
        expect((new DeviceTimezone)->get())->toBeNull();
    });
});
