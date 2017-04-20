<?php

require __DIR__.'/config.php';

/**
 * Sanitize URL string
 * 
 * @param string $url String to parse
 * 
 * @return string Parsed URL
 */
function sanitizeURL($url)
{
    filter_var($url, FILTER_SANITIZE_URL);
    return preg_replace('/&(?!amp;)/', '&amp;', $url);
}

/**
 * Extract JSON array from the specified URL query variable
 * 
 * @param string $qvar URL query variable to decode
 * 
 * @return array JSON array or null in case of error
 */
function extractJSON($qvar = 'x')
{
    $json = array();
    if (empty($_GET[$qvar])) {
        return $json;
    }

    $data = base64_decode($_GET[$qvar]);
    if ($data === false) {
        return $json;
    }

    $decoded = @gzinflate($data);
    if ($decoded === false) {
        return $json;
    }

    return json_decode($decoded, true);
}

/**
 * Check if the JSON is valid
 * 
 * @param array $json Array to sanitize
 * 
 * @return array JSON array with sanitized values
 */
function checkJSON($json)
{
    if (empty($json['url']) || (strpos($json['url'], SRV_IDP_URL) !== 0)) {
        // We ensure that the sent URL matches the configured one
        http_response_code(400);
        echo getPageHeader('400 Bad Request').getPageFooter();
        exit;
    }

    return $json;
}

/**
 * Get the HTML page header
 * 
 * @param string $title Page title
 * 
 * @return string
 */
function getPageHeader($title)
{
    return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" '
        .'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n"
        .'<html xmlns="http://www.w3.org/1999/xhtml">'."\n"
        .'<head>'."\n"
        .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n"
        .'<title>'.$title.'</title>'."\n"
        .'<link href="sso.css" rel="stylesheet" type="text/css" />'."\n"
        .'<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet" />'."\n"
        .'</head>'."\n"
        .'<body>'."\n"
        .'<div class="wrapper"><a class="logo" href="https://www.example.com/" target="_blank">Demo</a></div>'."\n"
        .'<div class="wrapper content">'."\n"
        .'<h1>'.$title.'</h1>'."\n";
}

/**
 * Get the HTML page footer
 * 
 * @param string $srvIdpURL Public URL of the srv-idp
 * 
 * @return string
 */
function getPageFooter()
{
    return '</div>'."\n"
        .'<div style="position:absolute;top:0;right:0;margin:10px;">'
        .'<a href="'.SRV_IDP_URL.'/services" title="SSO Login" class="btn">SSO LOGIN</a> '
        .'<a href="'.SRV_IDP_URL.'/logout" title="Terminate the main SSO session" class="btn">SSO LOGOUT</a>'
        .'</div>'."\n"
        .'</body>'."\n"
        .'</html>'."\n";
}
