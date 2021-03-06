<?php

    class li_appcontroller_article
    {
        public function __construct()
        {
            li_env::use('model',    $this->mol);
            li_env::use('response', $this->res);
            li_env::use('app',      $this->app);

            $this->mol->use('article', $this->art);
        }

        public function settings()
        {
            $this->mol->use('settings', $settings);
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':

                    $this->res->json($settings->get());

                break;

                case 'PATCH':

                    //Edit

                break;

                default: $this->app->notallowed();
            }
        }

        private function article_delete(int $id)
        {
            if($id === 0)
            {
                $this->res->set('Parameter "id" wajib')->status(422);
            }

            else
            {
                $this->art->delete($id);
                $this->res->set("Artikel $id berhasil dihapus");
                
            }
        }

        private function article_write()
        {}

        private function article_update()
        {}

        private function article_get(string $mode, $param)
        {
            switch($mode)
            {
                case 'list':

                    $data = $this->art->list(intval($_GET['limit']), intval($_GET['offset']), intval($_GET['draft']));

                break;

                case 'read':

                    $data = $this->art->read($param);

                break;

                case 'search':

                    $data = $this->art->search(strval($_GET['query']), intval($_GET['limit']), intval($_GET['offset']), intval($_GET['draft']));

                break;

                case 'tag':

                    $data = $this->art->tag(strval($param), intval($_GET['limit']), intval($_GET['offset']), intval($_GET['draft']));

                break;

                default: $this->app->notfound();
            }

            if(isset($data))
            {
                $this->res->json($data);
            }
        }

        public function index($mode = 'list', $param = '')
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':

                    $this->article_get($mode, $param);

                break;

                case 'POST':

                   // $this->article_write();

                break;

                case 'PATCH':

                   // $this->article_update(intval($_GET['id']));

                break;

                case 'DELETE':

                    $this->article_delete(intval($_GET['id']));

                break;

                default: $this->app->notallowed();
            }
        }
    }