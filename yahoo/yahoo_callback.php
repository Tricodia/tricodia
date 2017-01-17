<?php
require_once('globals.php');
require_once('oauth_helper.php');
// Fill in the next 3 variables.
$request_token = $_SESSION['request_token'];
$request_token_secret = $_SESSION['request_token_secret'];
$oauth_verifier = $_GET['oauth_verifier'];
// Get the access token using HTTP GET and HMAC-SHA1 signature
$retarr = get_access_token_yahoo(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $request_token, $request_token_secret, $oauth_verifier, false, true, true);
if (! empty($retarr)) {
list($info, $headers, $body, $body_parsed) = $retarr;
if ($info['http_code'] == 200 && !empty($body)) {
$guid = $body_parsed['xoauth_yahoo_guid'];
$access_token = rfc3986_decode($body_parsed['oauth_token']) ;
$access_token_secret = $body_parsed['oauth_token_secret'];
// Call Contact API
$retarrs = callcontact_yahoo(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $guid, $access_token, $access_token_secret, false, true);
echo "<pre/>";
}}
?>

<!--HTML Code (Interface) -->
<html>
<head>
<title>Export Yahoo Contacts Using PHP</title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<script src="js/logout.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
<h1>Export Yahoo Contacts Using PHP</h1>
<div id="login">
<div id="h2" class="h2 row">
<div class="csv col-md-3"><a href ="https://www.formget.com/tutorial/export-yahoo-contacts-using-php/download.php?<?php echo http_build_query($retarrs); ?>" id="download"><img class="img-responsive" src="images/download-csv-icon.gif"></a></div>
<div class="col-md-6"><h2><span>Yahoo Contacts</span></h2></div>
<div class="col-md-3"><a href ="#" onclick="caller()" id="logout"><img class="img-responsive" src="images/button-power_green.png"></a></div>
</div>
<div class="row">
<div class="col-md-12">
<table cellspacing='0'>
<thead>
<td>Name</td>
<td>Email</td>
</thead>
<?php
foreach ($retarrs as $key => $value) {?>
<tr>
<td><?php echo $value['name']; ?></td>
<td><?php echo $value['email']; ?></td>
</tr>
<?php }
?>
</table>
</div>
</div>
</div>
</div>
</body>
</html>