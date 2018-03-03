<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <title>Washer Subscription</title>
        
</head>
<body>
<div style="text-align: center;">
    <img src="{{ url('themes/stagemetro/images/loading.gif') }}" alt="" width="200px">
</div>
    

<script>

        var userAgentString = navigator.userAgent.toLowerCase();        		
        if (userAgentString.indexOf("iphone") > -1 || userAgentString.indexOf("ipod") > -1 || userAgentString.indexOf("ipad") > -1) {
            var deeplink = "washmycar://washer/subscription/<?php echo $accessToken ?>";
            window.location.href = deeplink;

            setTimeout(function () {
                alert("This is on ios device but deeplink not working, deeplink = " + deeplink);
            }, 8000);
        } else if (/android/.test(userAgentString)) {
            var deeplink = "washmycar://washer/subscription/<?php echo $accessToken ?>";
            window.location.href = deeplink;
            
            setTimeout(function () {
                alert("This is on android device but deeplink not working, deeplink = " + deeplink);
            }, 8000);
        } else if (userAgentString.indexOf("mac") > -1) {
            console.log('This is a Macbook, please open this link on mobile device');
        } else {
            console.log('This is on Windows or Desktop Browser, please open this link on mobile device');
        }
</script>
</body>
</html>
