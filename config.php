<?php
    function fix_home($path) {
        $begin = substr($path, 0, 6);

        if ($begin == '/home/')
            $path = '/~' . substr($path, 6);

        return $path;
    }

    function get_root() {
        $root = __DIR__;

        if ($root == '/')
            $root = '';
        else
            $root = fix_home($root);

        return "//$_SERVER[HTTP_HOST]$root/";
    }

    define('ROOT', get_root());
?>
