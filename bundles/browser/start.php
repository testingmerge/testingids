<?php

Autoloader::map(array(
	'Browser'	=> __DIR__ . DS . 'browser.php'
));


Laravel\IoC::singleton('Browser', function()
{
    return new Browser($_SERVER['HTTP_USER_AGENT']);
});