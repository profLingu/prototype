<?php

    class li_appmodel_settings
    {
        public function __construct()
        {
            li_env::use('app')->pdo($this->pdo);
        }

        public function get()
        {
            $query = '
                SELECT  *

                FROM    `li_settings`
            ';

            return $this->pdo->query($query)->fetchAll();
        }
    }