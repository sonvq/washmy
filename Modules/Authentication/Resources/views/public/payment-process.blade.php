<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <title>Washer Subscription</title>
        
</head>
<body>

<script>

        if(window.location.hash) {
            var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
            var access_token_string = hash.slice(0, hash.indexOf('&'));
            var access_token = access_token_string.split("=")[1];            
            // hash found
            
            var userAgentString = navigator.userAgent.toLowerCase();        		
            if (userAgentString.indexOf("iphone") > -1 || userAgentString.indexOf("ipod") > -1 || userAgentString.indexOf("ipad") > -1) {

                setTimeout(function () {        
                    var deeplink = "washmycar://washer/subscription/" + access_token;
                    alert("This is on ios device and deeplink = " + deeplink);
                    document.location.href = deeplink;
                    alert("Redirect called");
                });

            } else if (/android/.test(userAgentString)) {
                setTimeout(function () {        
                    var deeplink = "washmycar://washer/subscription/" + access_token;
                    alert("This is on android device and deeplink = " + deeplink);
                    document.location.href = deeplink;
                    alert("Redirect called");
                });
            } else if (userAgentString.indexOf("mac") > -1) {
                console.log('This is a Macbook, please open this link on mobile device');
            } else {              
                console.log('This is on Windows or Desktop Browser, please open this link on mobile device');
            }
        } 
        
        
</script>
</body>
</html>
