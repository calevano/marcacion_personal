<?php

/*
|--------------------------------------------------------------------------
| Mail Configuration
|--------------------------------------------------------------------------
|
| Mail Configuration for send emails using Mail services like Mailgun and Mailchimp
|
*/
$config['email']['protocol']     = 'smtp';
$config['email']['smtp_host']    = 'smtp.mailgun.org';
$config['email']['smtp_port']    = '587';
$config['email']['smtp_timeout'] = '30';
$config['email']['smtp_user']    = 'postmaster@sandbox853bec0a491c4797a38ef8bfd62870da.mailgun.org';
$config['email']['smtp_pass']    = 'f871d044ef0db31179093adaa7854cdb';
$config['email']['smtp_crypto']  = '';
$config['email']['charset']      = 'utf-8';
$config['email']['mailtype']     = 'html';
$config['email']['wordwrap']     = TRUE;
$config['email']['newline']      = "\r\n";
