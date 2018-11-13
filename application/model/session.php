<?php

    class li_appmodel_session
    {
        public function __construct()
        {
            session_name('L1N6U');
            session_start();
        }

        private function key(string $key)
        {
            return sha1('L1N6U_'.$key);
        }

        public function set(string $key, $val)
        {
            $_SESSION[$key = $this->key($key)] = $val;
        }

        public function get(string $key)
        {
            return @$_SESSION[$this->key($key)];
        }
    }