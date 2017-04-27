<?php
declare(strict_types=1);

namespace Application\Domain;

use Cadre\DomainSession\SessionManager;

class Home
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke($sessionId)
    {
        $session = $this->sessionManager->start($sessionId);

        $lastTimestamp = $session->timestamp ?? 'Unknown';

        $session->timestamp = date('Y-m-d H:i:s');

        $this->sessionManager->finish($session);

        return [
            'success' => true,
            'session' => $session,
            'timestamp' => $lastTimestamp,
        ];
    }
}
