<?php

    final class li_appbootstrap extends li_sysabstract_boot
    {
        private $pdo = null;

        public function __construct()
        {
            li_env::use('response', $this->response);
        }

        public function pdo(&$useas = null)
        {
            if(!isset($this->pdo))
            {
                li_appconfig_mysql::use($dbconf);
                $this->pdo = new PDO
                (
                    "mysql:host=".$dbconf->host().";dbname=".$dbconf->name(),
                    $dbconf->user(),
                    $dbconf->pass(),
                    $dbconf->conf()
                );
            }

            return $useas = $this->pdo;
        }

        public function keyfilter(array &$attr, array $data)
        {
            return $attr = li_env::use('router')->input($attr, $data);
        }

        public function notfound()
        {
            $this->response
                 ->set('Berkas tidak ditemukan.')
                 ->status(404);
        }

        public function notallowed()
        {
            $this->response
                 ->set('Metode HTTP tidak bisa diterima.')
                 ->status(405);
        }
    }