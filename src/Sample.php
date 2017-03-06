<?php
use Aura\Payload\Payload;
use Aura\Payload_Interface\PayloadStatus;
use Cadre\DomainSession\SessionManager;
use Cadre\DomainSession\Storage\Files;

class Sample
{
    private $manager;

    public function __construct(SessionManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke($id)
    {
        $payload = new Payload();

        $session = $this->manager->start($id);

        // echo "<pre>";
        // echo bin2hex($id) . "\n";
        // echo bin2hex($session->getId()->value()) . "\n";
        // var_dump($session->asArray());
        // exit;

        if (isset($session->timestamp)) {
            $session->lastTimestamp = $session->timestamp;
        } else {
            $session->lastTimestamp = 'Unknown';
        }

        $session->timestamp = date('Y-m-d H:i:s');

        $this->manager->finish($session);

        return $payload
            ->setStatus(PayloadStatus::SUCCESS)
            ->setOutput($session);
    }
}
