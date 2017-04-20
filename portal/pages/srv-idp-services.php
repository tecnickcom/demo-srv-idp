<?php
// Display services message from srv-idp.
// The URL of this page should be set in the "servicesPageURL" configuration parameter of srv-idp.

require __DIR__.'/process.php';

$json = checkJSON(extractJSON('x'));

$out = getPageHeader('SSO Authorized Service Providers');

if (!empty($json['splist'])) {
    $splist = '';
    foreach ($json['splist'] as $item) {
        filter_var($item['name'], FILTER_SANITIZE_STRING);
        filter_var($item['description'], FILTER_SANITIZE_STRING);
        $item['login'] = sanitizeURL($item['login']);
        $item['logout'] = sanitizeURL($item['logout']);
        $item['idplogin'] = sanitizeURL($item['idplogin']);
        $logo = 'img/'.$item['name'].'.png';
        if (!file_exists($logo)) {
            $logo = 'img/0.png'; // default blank image
        }
        $splist .= '<li>'
            .'<a href="'.$item['login'].'" title="Login: '.$item['description'].'" class="spname" target="_blank">'.$item['name'].'</a>'
            .'<a href="'.$item['login'].'" title="Login: '.$item['description'].'" target="_blank">'
            .'<img src="'.$logo.'" alt="Logo: '.$item['name'].'" width="100%" />'
            .'</a>'
            .'<div class="buttons">'
            .'<a href="'.$item['login'].'" title="Login: '.$item['description'].'" class="btn" target="_blank">LOGIN</a> '
            .'<a href="'.$item['login'].'" title="Logout: '.$item['description'].'" class="btn" target="_blank">LOGOUT</a>'
            .'</div>'
            .'<p>'.$item['description'].'</p>'
            .'</li>';
    }
    if (!empty($splist)) {
        $out .= '<ul>'.$splist.'</ul>'."\n";
    }
}

$out .= getPageFooter();

echo $out;
