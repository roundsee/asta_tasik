<?php
function write_log($message, $level = 'INFO')
{
    $log_path = __DIR__ . '/logs/';

    if (!is_dir($log_path)) {
        mkdir($log_path, 0777, true);
    }

    // kalau message array / object → stringify
    if (is_array($message) || is_object($message)) {
        $message = json_encode(
            $message,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }

    $filename  = $log_path . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');

    $content = "[$timestamp] [$level] " . $message . PHP_EOL;

    file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);
}