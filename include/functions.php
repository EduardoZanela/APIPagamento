<?php
    require_once('../config.php');

    function get_url() {
        return "//$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]";
    }

    function get_dir() {
        return dirname(get_url()) . '/';
    }
?>
