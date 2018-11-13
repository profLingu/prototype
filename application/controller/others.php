<?php

    final class li_appcontroller_others
    {
        public function __construct()
        {
            li_env::use('model')->use('session', $this->session);
        }

        public function captcha()
        {
            $code             = rand(100000, 999999);
            $imwidth          = 127;
            $imheight         = 26;
            $im               = ImageCreate($imwidth, $imheight);
            $background_color = ImageColorAllocateAlpha($im, 255, 255, 255, 127);
            $text_color       = ImageColorAllocateAlpha($im, 0, 0, 0, 20);
            $border_color     = ImageColorAllocate($im, 120, 120, 120);
            $line_color       = imageColorAllocate($im, 120, 120, 120);
            for($i = 0; $i <= 127; $i += 6)
            {
                imageline($im, rand(0, 127), 0, rand(0, 127), 25, $line_color);
                imageline($im, $i, 0, $i, 25, $line_color);
            }

            for($i = 0; $i <= 25; $i += 5)
            {
                imageline($im, 0, rand(0, 25), 127, rand(0, 25), $line_color);
                imageline($im, 0, $i, 127, $i, $line_color);
            }

            for($x = $i = 0; $i < strlen($code); $i++)
            {
                $x          += rand(10, 20);
                $y           = rand(0, 10);
                $font        = rand(4, 20);
                $single_char = substr($code, $i, 1);
                imagechar($im, $font, $x, $y, $single_char, $text_color);
            }

            $this->session->set('captcha', $code);
            $im = function() use($im)
            {
                ImagePng($im);
                ImageDestroy($im);
            };

            li_env::use('response')->closure($im)->type('image/png');
        }
    }