<?php
require_once('globals.php');
require_once('oauth_helper.php');
// Callback URL
$callback = "https://tricodia.github.io/yahoo/yahoo_callback.php";
// Get the request token using HTTP GET and HMAC-SHA1 signature
$retarr = get_request_token(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $callback, false, true, true);
if (! empty($retarr)){
list($info, $headers, $body, $body_parsed) = $retarr;
if ($info['http_code'] == 200 && !empty($body)) {
$_SESSION['request_token'] = $body_parsed['oauth_token'];
$_SESSION['request_token_secret'] = $body_parsed['oauth_token_secret'];
$_SESSION['oauth_verifier'] = $body_parsed['oauth_token'];
$url = urldecode($body_parsed['xoauth_request_auth_url']);
}
}
?>

<!--HTML Code (Interface) -->
<html>
<head>
<title>Export Yahoo Contacts Using PHP</title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container-fluid">
<h1>Export Yahoo Contacts Using PHP</h1>
<div id="login">
<div class="row">
<div class="col-md-12">
<h2 id="h2">Yahoo Sign-in</h2>
</div>
</div>
<div class="row">
<div class="col-md-12">
<a id="signin" href="<?php echo $url; ?>"><img id="signinwithyahoo" class="img-responsive" src="images/sign-in-with-yahoo.png"></a>
</div>
</div>
</div>
</div>
</body>
</html>