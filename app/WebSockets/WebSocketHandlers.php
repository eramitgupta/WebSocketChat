<?php
namespace App\WebSockets;
// YourWebSocketHandler.php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketHandlers implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Handle a new WebSocket connection.
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Handle WebSocket message received from a client.
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Handle WebSocket connection closure.
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Handle WebSocket errors.
        $conn->close();
    }
}
