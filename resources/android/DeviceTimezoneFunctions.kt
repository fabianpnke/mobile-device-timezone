package com.fabianpankoke.plugins.devicetimezone

import androidx.fragment.app.FragmentActivity
import com.nativephp.mobile.bridge.BridgeFunction
import com.nativephp.mobile.bridge.BridgeResponse
import java.util.TimeZone

object DeviceTimezoneFunctions {

    /** Returns the device's current IANA timezone identifier (e.g. "Europe/Vienna"). */
    class Get(private val activity: FragmentActivity) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            return BridgeResponse.success(mapOf(
                "identifier" to TimeZone.getDefault().id
            ))
        }
    }
}
