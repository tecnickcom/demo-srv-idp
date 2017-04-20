<?php

$settings = array (
    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => false,

    // Enable debug mode (to print errors)
    'debug' => true,

    // Set a BaseURL to be used instead of try to guess 
    // the BaseURL of the view that process the SAML Message.
    // Ex. http://sp.example.com/
    //     http://example.com/sp/ 
    'baseurl' => 'http://127.0.0.1:52080/php-saml/demo2/',

    // Service Provider Data that we are deploying
    'sp' => array (
        // Identifier of the SP entity  (must be a URI)
        'entityId' => 'http://127.0.0.1:52080/php-saml/demo2',
        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array (
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'http://127.0.0.1:52080/php-saml/demo2/acs.html',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
        ),
        // If you need to specify requested attributes, set a
        // attributeConsumingService. nameFormat, attributeValue and
        // friendlyName can be omitted. Otherwise remove this section. 
        "attributeConsumingService"=> array(
                "ServiceName" => "SP test",
                "serviceDescription" => "Test Service",
                "requestedAttributes" => array(
                    array(
                        "name" => "",
                        "isRequired" => false,
                        "nameFormat" => "",
                        "friendlyName" => "",
                        "attributeValue" => ""
                    )
                )
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        'singleLogoutService' => array (
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'http://127.0.0.1:52080/php-saml/demo2/slo.php',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
 
        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => 'MIIDiTCCAnGgAwIBAgIJALzXd7RUdNwcMA0GCSqGSIb3DQEBCwUAMFsxCzAJBgNVBAYTAlVLMQ8wDQYDVQQIDAZMb25kb24xDzANBgNVBAcMBkxvbmRvbjEUMBIGA1UECgwLRGV2ZWxvcG1lbnQxFDASBgNVBAMMC2V4YW1wbGUuY29tMB4XDTE3MDQxOTA5NTk0M1oXDTIwMDExNDA5NTk0M1owWzELMAkGA1UEBhMCVUsxDzANBgNVBAgMBkxvbmRvbjEPMA0GA1UEBwwGTG9uZG9uMRQwEgYDVQQKDAtEZXZlbG9wbWVudDEUMBIGA1UEAwwLZXhhbXBsZS5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDjkNee4MFsDKnKS3vSBn7xF8RWNLicxhMkW7IZrx8KcTpLg86Tt7trdQxkALgaDc2jXCsQodPtNEZzthq+G9BUF4/R+i5ttzk8KvnUJTYXGpyamtcu6N0x6nEm+R0QIcBloH4FBIhRb6NwlT6GMqdn36aFtOjjx5tPVnJEA5+Ka3slPivq+KoGeXW2kqrtkx8kdfOjUfDg1AOvkakojgyaZ+fjEFioktaUchSd5LDAWnXo+kPOkgVpV3Eky8/OEBfrfzuouSWnOBnTp+HByC2//eoZZudtNmU/DB0QSXrsHdRXfBBQWjqRZ9BdF8TBFjA7yP0WdPe8mV7hbYb+2gVxAgMBAAGjUDBOMB0GA1UdDgQWBBSN3xQREwXZJ/L08wntibfJbXt8EDAfBgNVHSMEGDAWgBSN3xQREwXZJ/L08wntibfJbXt8EDAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQAYOMFbPiUn00uDGzIzsjhR2ZgZeG7FVGUykMP/O+fbzwOo7xuwe4Rk54eXopSuD4fwqGx2Js3Lq/PSyxQ9oyMMGuvoKKT+IcSnwRbxkne0MPAp8JbDklcpCd6totXGzZNEFbwne94PUMRdlFbnEYMN3YjABuSfqyu7clAYCgfMZKA+cF0qSILI1l9fTtUWr8fv2DkgkHEvS/cXI1QDhWBsgNTpM+GltMhLXmpgPSIsGrD40Y221Y1Cy1mVX3x/he3Wc8HodvUhXs15MVi6w5Cm4+jbb5jC0fYlyfruZwiBuVBEPvJQKUhlFOAlAx2S5UF9A31zB/LXeChwjatB+jVf',
        'privateKey' => 'MIIEwAIBADANBgkqhkiG9w0BAQEFAASCBKowggSmAgEAAoIBAQDjkNee4MFsDKnKS3vSBn7xF8RWNLicxhMkW7IZrx8KcTpLg86Tt7trdQxkALgaDc2jXCsQodPtNEZzthq+G9BUF4/R+i5ttzk8KvnUJTYXGpyamtcu6N0x6nEm+R0QIcBloH4FBIhRb6NwlT6GMqdn36aFtOjjx5tPVnJEA5+Ka3slPivq+KoGeXW2kqrtkx8kdfOjUfDg1AOvkakojgyaZ+fjEFioktaUchSd5LDAWnXo+kPOkgVpV3Eky8/OEBfrfzuouSWnOBnTp+HByC2//eoZZudtNmU/DB0QSXrsHdRXfBBQWjqRZ9BdF8TBFjA7yP0WdPe8mV7hbYb+2gVxAgMBAAECggEBAJrq9M7VBPgQmtn7jxyIjYyFeISTOYaIlWlv/wvbGs+aC2xzG4OWVcGumjPOBYa/FNn8Gdklwcc+iiOlugjnmGhW7fKtVUQdspoSS6cveeY6mJfrh0gJAORFTKiSeEWOJJNKsd+qmT6POH2hLEJhY3OkXpGxecXvEfztxbYlnUu13SMqgOfLmSgGO2ewltnbqUXKM1N2MUo01lE+cT66szgklvtBcXDgx5ZROYl4COEdtxNTesJ64Vltg+B/gmfPXaPGJ+ossmBfEv013SaXSedsOvVd/sJUN06+cHcUQ+aV8D+Zv7ryhY72EYFYgLL4s5SKs79syriWms4bbFW0FT0CgYEA9NwUWi13qU1rTcKRBo6lwsA+X5nNwWkS6Vsw54nduHN+YkNpNxGvOwpy8BPSMpBZ494Sqoq/cuRYFcu/KaC8Qtv02+f8ykEERFZaYE7P2p/eJoU/ZWb2GE3h+7urQkI+6/m4A6X6R+uXzZ2zj32kLO9iPO8nBU0qc98azN1CTQ8CgYEA7etWhIukynd5Q7VNQoNB1DcS3bKTxW14my/c4hzyl1mzPW3kAdbdxm4Nw5G5MkvOGR1KroBdtTcfVTVISNXjQCFwPrwROW4UANgRJVFGKc7VVZ5OGdCqEKov7KK8iQNrKAasvWoOa3JW2cDMFRxfhxZEhCIu4ACxscHVKoJDhX8CgYEAocUs5Q8Y+Y+ejvc2nWBs/yfHjZ2tpFRpHCcVPkOFarFTFFR5FNroLFeQ7DAMNT/NQ5CaQHX+WkemMnAz0arR9lIfiZHRH0apLQToHKy1AjmQqV5rLfFCMXhzDr9EPDhMHdcTzcVAf3eVCVFhKjHV36IgAyX1X7lFjNwfdq3Ped0CgYEAmKPJyBPHT9ZCyHvC649GZp5GzlFJmPpYzEdy0OZ9hTiZVCnyhHOTqUDmN7iANpKH0XkHdtkIRcDtqz8Z9xCyUWyilL0X196Vms0EgwqXly8Jk3qS5OEImtR1Fr55cvXsg6t0m7k1Mx4SNnYI+OpRJ1vT7Wn45OHNHxwaZMFaDIUCgYEAsQZVidnzMpXIR5zDwqBK4uyVIK2nySNsfncUL7ym1evSmzLDiBz0AAs/l+yJAsdZqXX3DvygiXYSZb07shG4gGSM0K3ulBKwQuf0WrrIYeiW9GV2oVNZx2PYR/fIVFx6Yuz9npzKgxpkGLWLsqs+d6fjBX/gr5PwvcSKyF8qOjU=',
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array (
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => 'http://127.0.0.1:8000',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array (
            // URL Target of the IdP where the SP will send the Authentication Request Message
            'url' => 'http://127.0.0.1:8000/sso',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-POST binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array (
            // URL Location of the IdP where the SP will send the SLO Request
            'url' => 'http://127.0.0.1:8000/logout',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Public x509 certificate of the IdP
        'x509cert' => 'MIIDiTCCAnGgAwIBAgIJAKIjrX7n50HsMA0GCSqGSIb3DQEBCwUAMFsxCzAJBgNVBAYTAlVLMQ8wDQYDVQQIDAZMb25kb24xDzANBgNVBAcMBkxvbmRvbjEUMBIGA1UECgwLRGV2ZWxvcG1lbnQxFDASBgNVBAMMC2V4YW1wbGUuY29tMB4XDTE3MDQxOTA5NTk0M1oXDTIwMDExNDA5NTk0M1owWzELMAkGA1UEBhMCVUsxDzANBgNVBAgMBkxvbmRvbjEPMA0GA1UEBwwGTG9uZG9uMRQwEgYDVQQKDAtEZXZlbG9wbWVudDEUMBIGA1UEAwwLZXhhbXBsZS5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDVK4D1BRZIksdrxe67ArMRnfZ8qoiNDBG5DIQGNWdp/JxTW8z36+81+/eJX02VHq4QEb1XsmjRDLhxS8fYEiTSdYkoiIlzEwgdj87ghMsr3Od9hVjqsKlr4f1FmCBA2WWcJpZt4ugpgN7NJ/5axqPWAesvBEF8yqjXqZPc4E1AjqhXhCmfjWxKibK+rzn8pQ9H8VANByh28336RAUPk3AVTTWJ5ja2T5BBvGD5QyMG8+gB1uzgoxIVLOxAEGGB/tn2tJ6IUfFt/vrxRp38XZA38rSUCdwP14bw3QKspW/LzUac5DXXp80CGCZ44gRPbNxRYBUvpRef44rXpp1+V2rdAgMBAAGjUDBOMB0GA1UdDgQWBBT0YahgpJCdAcogqExnUbfYWM/ngDAfBgNVHSMEGDAWgBT0YahgpJCdAcogqExnUbfYWM/ngDAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQB9WzkToW8WCV7KBEX/Eay+1nk3SCPO3zW9bzOgaS0fGK0HtyqILdd45FeLTAUp+ToYvlnVxecx92bN+tD8Fi5Gi91ci6Du616ZLsJZbQVFXQnWp2r5HAUrba8D8M5QM8hF0AWZiuguuStU2mzgMB7uZ9MpkGtW2PdXrCL5CTrGZ0FbLcM2tOJ4TJkNUpy9JRCxPyR0nVCnR8YfN1EW6oTlJW6HoTu2pVCCH9Wx4Jyf4jfNnqiFds+nM+jnQUvAYcEr2N5pTE+uF/idCuiup81agn+7uHAtkMkUXkx8sgl0xy1ulxTIsKkmnB39oOVItDPjq8yV8cwGuqWyMJwrm456',
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it,
         *   or add for example the -sha256 , -sha384 or -sha512 parameter)
         *
         *  If a fingerprint is provided, then the certFingerprintAlgorithm is required in order to
         *  let the toolkit know which Algorithm was used. Possible values: sha1, sha256, sha384 or sha512
         *  'sha1' is the default value.
         */
        // 'certFingerprint' => '',
        // 'certFingerprintAlgorithm' => 'sha1',
    ),
);
