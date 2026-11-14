<?php

 class Csrf
 {
    // create the token once per session and return it
    public static function token(): string
    {
        if(empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function field(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . self::token() . '">';
    }
    public static function check(): void
    {
        $sent = $_POST['csrf_token'] ?? '';

        if(!is_string($sent) || !hash_equals($_SESSION['csrf_token'] ?? '', $sent)) {
            http_response_code(403);
            exit('403 - Invalid CSRF token');
        }
    }
 }