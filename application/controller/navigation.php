<?php

    class li_appcontroller_navigation
    {
        public function __construct()
        {
            li_env::use('response', $this->res);
            li_env::use('app',      $this->app);

            li_env::use('model')->use('navigation', $this->nav);
        }

        public function index()
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':

                    $this->res->json($this->nav->list());

                break;

                default: $app->notallowed();
            }
        }

        private function nav_add()
        {
            
        }

        private function nav_get()
        {
            
        }

        private function nav_update()
        {
            
        }

        private function nav_delete()
        {
            
        }
    }