<?php
// Display logout message from srv-idp.
// The URL of this page should be set in the "logoutPageURL" configuration parameter of srv-idp.

require __DIR__.'/process.php';

$json = checkJSON(extractJSON('x'));

$out = getPageHeader('SSO LOGOUT');

$out .= '<p class="message">The IDP Session has been successfully deleted</p>'."\n";

if (!empty($json['splist'])) {
    $splist = '';
    foreach ($json['splist'] as $name => $logout) {
        filter_var($name, FILTER_SANITIZE_STRING);
        $logout = sanitizeURL($logout);
        $logo = 'img/'.$name.'.png';
        if (!file_exists($logo)) {
            $logo = 'img/0.png'; // default blank image
        }
        $splist .= '<li>'
            .'<a href="'.$logout.'" title="Logout: '.$name.'" class="spname" target="_blank">'.$name.'</a>'
            .'<a href="'.$logout.'" title="Logout: '.$name.'" target="_blank">'
            .'<img src="'.$logo.'" alt="Logo: '.$name.'" width="100%" />'
            .'</a>'
            .'<div class="buttons">'
            .'<a href="'.$logout.'" title="Logout: '.$name.'" class="btn" target="_blank">LOGOUT</a>'
            .'</div>'
            .'</li>';
    }
    if (!empty($splist)) {
        $out .= '<h2>Logout links of visited Service Providers:</h2>'."\n"
            .'<ul>'.$splist.'</ul>'."\n";
    }
}

$out .= getPageFooter();

echo $out;
