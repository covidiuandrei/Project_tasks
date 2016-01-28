<?php

if (! function_exists('post_value')) {
    function post_value($field, $default = '') {
        if (isset($_POST[$field])) {
            return $_POST[$field];
        } else {
            return $default;
        }
    }
}
