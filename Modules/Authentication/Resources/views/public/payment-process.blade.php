<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <title>Washer Subscription</title>
        
</head>
<body>

<script>

        
        var userAgentString = navigator.userAgent.toLowerCase();        		
        if (userAgentString.indexOf("iphone") > -1 || userAgentString.indexOf("ipod") > -1 || userAgentString.indexOf("ipad") > -1) {

            setTimeout(function () {        
                var deeplink = "washmycar://washer/subscription/<?php echo $accessToken ?>";
                alert("This is on ios device and deeplink = " + deeplink);
                document.location.href = deeplink;
                alert("Redirect called");
            });
            
        } else if (/android/.test(userAgentString)) {
            setTimeout(function () {        
                var deeplink = "washmycar://washer/subscription/<?php echo $accessToken ?>";
                alert("This is on android device and deeplink = " + deeplink);
                document.location.href = deeplink;
                alert("Redirect called");
            });
        } else if (userAgentString.indexOf("mac") > -1) {
            console.log('This is a Macbook, please open this link on mobile device');
        } else {
            console.log('This is on Windows or Desktop Browser, please open this link on mobile device');
        }
</script>
</body>
</html>
