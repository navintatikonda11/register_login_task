<?php
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url)
{
    header("Location: $url");
    exit();
}

function logMessage($message)
{
    $logFile = __DIR__ . '/../logs/log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}
