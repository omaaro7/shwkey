export function getInfo () {
    function parseUserAgent(uaString) {
        // Regular expressions to match various parts of the user-agent string
        var browserRegex = /(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i;
        var osRegex = /(windows|mac os|android|linux|iphone|ipad)/i;
    
        // Parsing user-agent string
        var browserMatch = uaString.match(browserRegex);
        var osMatch = uaString.match(osRegex);
    
        // Extracting browser and OS
        var browser = browserMatch && browserMatch[1].toLowerCase();
        var os = osMatch && osMatch[1].toLowerCase();
    
        // Determine device type based on the OS
        var deviceType;
        if (os === "iphone" || os === "ipad") {
            deviceType = "Mobile";
        } else if (os === "android") {
            deviceType = "Mobile";
        } else if (/windows|mac os|linux/i.test(os)) {
            deviceType = "Desktop";
        } else {
            deviceType = "Unknown";
        }
    
        return {
            browser: browser,
            os: os,
            deviceType: deviceType
        };
    }
    
    // Usage
    var userAgentInfo = parseUserAgent(navigator.userAgent);
    console.log("Browser:", userAgentInfo.browser);
    console.log("Operating System:", userAgentInfo.os);
    console.log("Device Type:", userAgentInfo.deviceType);
}