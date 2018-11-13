<?php

    class li_appconfig_mysql
    {
        public static function use(&$useas = null)
        {
            return $useas = new self;
        }

        public function host()
        {
            return 'localhost';
        }

        public function name()
        {
            return 'lingu_db1';
        }

        public function user()
        {
            return 'lingu';
        }

        public function pass()
        {
            return 'lingupw';
        }

        public function conf()
        {
            return
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
        }
    }