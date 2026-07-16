import Foundation

enum DeviceTimezoneFunctions {

    /// Returns the device's current IANA timezone identifier (e.g. "Europe/Vienna").
    class Get: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            return BridgeResponse.success(data: [
                "identifier": TimeZone.current.identifier,
            ])
        }
    }
}
