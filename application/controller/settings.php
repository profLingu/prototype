<?php

    class li_appcontroller_settings
    {
        public function index()
        {
            li_env::use('model')->use('settings', $settings);

            li_env::use('app',      $app);
            li_env::use('response', $res);
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':

                    $res->json($settings->get());

                break;

                case 'PATCH':

                    //Edit

                break;

                default: $app->notallowed();
            }
        }
    }