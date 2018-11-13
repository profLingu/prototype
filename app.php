<?php

    require(__dir__.'/system/environment.php');

    li_sysenvironment::autoloader(true);

    try
    {
    	li_sysenvironment::initialize(new li_applingu());
    }

    catch(throwable $e)
    {
       print $e;
    }