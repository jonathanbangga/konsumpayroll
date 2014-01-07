<?php
//phpinfo();


$to = "christopher.cuizon@techgrowthglobal.com";
$header = "From: {$to}";
$subject = "Hi! christopher.cuizon@techgrowthglobal.com";
$body = "Hi,\n\nHow are you?";

if (mail($to, $subject, $body, $header)) {
echo("<p>Message successfully sent!</p>");
} else {
echo("<p>Message delivery failed...</p>");
}

?>