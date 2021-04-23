<?php
    namespace Core;
    class View
    {
        public static function render($filename)
        {
            include "../views/$filename".".php";
        }
    }
?>