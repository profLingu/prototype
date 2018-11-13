<?php

    try
    {
        if(is_file($file = __dir__.'/vendor/autoload.php'))
        {
            require_once $file;
        }

        spl_autoload_register(function($class)
        {
            $from	= ['li_sys', 'li_app', '_'];
            $to		= ['system/', 'application/', '/'];
            $file	= str_replace($from, $to, $class);
            if(is_file($file = __dir__.'/'.$file.'.php'))
            {
                require_once $file;
            }
        });

        li_sysenvironment::run('li_appbootstrap');

    }

    catch(throwable $error)
    {
        print $error;
    }