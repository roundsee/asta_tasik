<?php
function write_log($message, $level = 'INFO') {
    $log_path = __DIR__ . '/logs/';
    if (!file_exists($log_path)) {
        mkdir($log_path, 0777, true);
    }
    
    $filename = $log_path . date('Y-m-d') . ".log";
    $timestamp = date('H:i:s');
    $content = "[$timestamp] [$level]: $message" . PHP_EOL;
    
    file_put_contents($filename, $content, FILE_APPEND);
}
