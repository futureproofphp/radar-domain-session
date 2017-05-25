<?php
require_once 'init.php';

use Application\Domain\Home;
use Cadre\DomainSession\SessionManager;

$sessionManager = $di->newInstance(SessionManager::class);
$session = $sessionManager->start(null);
$session->timestamp = '1981-08-27 17:00:00';
$sessionManager->finish($session);
$sessionId = $session->getId()->value();

$home = $di->newInstance(Home::class);
$payload = $home($sessionId);

echo "Timestamp: {$payload['timestamp']}\n";
