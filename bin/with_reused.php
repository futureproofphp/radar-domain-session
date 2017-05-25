<?php
require_once 'init.php';

use Application\Domain\Home;
use Cadre\DomainSession\SessionManager;

$sessionId = isset($argv[1]) ? $argv[1] : null;

$home = $di->newInstance(Home::class);
$payload = $home($sessionId);

echo "Timestamp: {$payload['timestamp']}\n";
echo "Session ID: {$payload['session']->getId()->value()}\n";
