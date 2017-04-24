<?php
// srv-idp public URL
$siu = getenv('SRV_IDP_URL') ?: 'http://127.0.0.1:8000';
define('SRV_IDP_URL', $siu);
