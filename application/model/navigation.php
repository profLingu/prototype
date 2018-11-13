<?php

    class li_appmodel_navigation
    {
        public function __construct()
        {
            li_env::use('app')->pdo($this->pdo);
        }

        public function list()
        {
            $query = "
                SELECT  *

                FROM    `li_navigations`

                LIMIT   25
            ";

            return $this->pdo->query($query)->fetchAll();
        }
    }