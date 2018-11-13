<?php

    class li_appmodel_article
    {
        private $app = null;
        private $pdo = null;

        public function __construct()
        {
            li_env::use('app', $this->app)->pdo($this->pdo);
        }

        public function write(array $param)
        {
            $query = "
                INSERT INTO `li_articles`
                (
                    `permalink`,
                    `datetime`,
                    `title`,
                    `text`,
                    `category`,
                    `by`,
                    `is_draft`,
                    `tags`
                )

                VALUES
                (
                    :permalink,
                    now(),
                    :title,
                    :text,
                    :category,
                    :by,
                    :is_draft,
                    :tags
                )
            ";

            $param = $this->app->keyfilter
                (
                    [
                        'permalink',
                        'title',
                        'text',
                        'category',
                        'by',
                        'is_draft',
                        'tags'
                    ],
    
                    $param
                );
            return $this->pdo->prepare($query)->execute($param);
        }

        public function read(string $permalink)
        {
            $query  = "
                SELECT      *

                FROM        `li_articles`

                WHERE       `is_draft` = 0 AND `permalink` = ?
            ";

            $stmt = $this->pdo->prepare($query);

            $stmt->execute([$permalink]);

            return $stmt->fetch();

        }

        public function list(int $limit, int $offset, int $is_draft = 0)
        {
            $query  = "
                SELECT      *

                FROM        `li_articles`

                WHERE       `is_draft` = $is_draft

                ORDER BY    `upat` DESC, `datetime` DESC

                LIMIT       $limit

                OFFSET      $offset
            ";

            return $this->pdo->query($query)->fetchAll();
        }

        public function search(string $keyword, int $limit, int $offset, int $draft)
        {
            $query  = "
                SELECT      *

                FROM        `li_articles`

                WHERE       `is_draft` = :draft AND (`title` LIKE :keyword ||  `text` LIKE :keyword)

                ORDER BY    `upat` DESC, `datetime` DESC

                LIMIT       $limit

                OFFSET      $offset
            ";

            $stmt = $this->pdo->prepare($query);

            $stmt->execute(['keyword' => '%'.$keyword.'%', 'draft' => $draft]);

            return $stmt->fetchAll();
        }

        public function tag(string $keyword, int $limit, int $offset, int $draft)
        {
            $query  = "
                SELECT      *

                FROM        `li_articles`

                WHERE       `is_draft` = :draft AND `tags` LIKE :keyword

                ORDER BY    `upat` DESC, `datetime` DESC

                LIMIT       $limit

                OFFSET      $offset
            ";

            $stmt = $this->pdo->prepare($query);

            $stmt->execute(['keyword' => '%'.$keyword.'%', 'draft' => $draft]);

            return $stmt->fetchAll();
        }

        public function update(int $id, array $param)
        {
            $query = "
                UPDATE `li_articles`
                (
                    `permalink`,
                    `title`,
                    `text`,
                    `category`,
                    `is_draft`,
                    `upby`, 
                    `upat`,
                    `tags`
                )

                VALUES
                (
                    :permalink,
                    :title,
                    :text,
                    :category,
                    :is_draft,
                    :upby,
                    now(),
                    :tags
                )
            ";

            $param = $this->app->keyfilter
                (
                    [
                        'permalink',
                        'title',
                        'text',
                        'cdtegory',
                        'is_draft',
                        'upby',
                        'tags'
                    ],
    
                    $param
                );
            return $this->pdo->prepare($query)->execute($param);
        }

        public function delete(int $id)
        {
            $query = "
                DELETE FROM `li_articles`

                WHERE       `id` = $id
            ";

            return $this->pdo->query($query);
        }
    }