<?php
require_once 'init.php';

use Application\Domain\Home;
use Cadre\DomainSession\SessionManager;

$home = $di->newInstance(Home::class);
$payload = $home(null);

echo "Timestamp: {$payload['timestamp']}\n";
