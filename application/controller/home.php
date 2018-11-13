<?php

    class li_appcontroller_home
    {
        public function index()
        {
            $html = '<html>
                        <body>
                            <lingu/>
                            <script src="/assets/script/app.js"></script>
                        </body>
                    </html>';

            li_env::use('response')->set($html)->type('text/html');
        }
    }