<?php

namespace App\Service;

use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackClient
{
    private $slack;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        if ($this->logger) {
            $this->logger->info('Beaming a message to Slack!');
        }

        $message = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($message);
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}