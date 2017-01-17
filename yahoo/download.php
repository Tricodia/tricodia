<?php

if(isset($_GET))
{
$retarrs = $_GET;
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Contacts.csv");
header("Pragma: no-cache");
header("Expires: 0");
$file = fopen('php://output', 'w');
fputcsv($file, array('Name', 'Email'));
foreach($retarrs as $key => $value) {
$data['name'] = $value['name'];
$data['email'] = $value['email'];
fputcsv($file, $data);
}
exit();
}
?>