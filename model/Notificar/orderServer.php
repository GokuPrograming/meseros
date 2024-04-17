<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require 'vendor/autoload.php';

class OrderServer implements MessageComponentInterface {
    protected $clients;
    protected $orders = [];

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nuevo cliente conectado\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);

        switch ($data['type']) {
            case 'newOrder':
                $order = $data['order'];
                $this->orders[$order['userId']] = $order;
                $this->notifyClient($order['userId'], $order);
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Cliente desconectado\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

    protected function notifyClient($userId, $order) {
        foreach ($this->clients as $client) {
            $clientData = json_decode($client->httpRequest->getUri()->getQuery(), true);
            if ($clientData['userId'] == $userId) {
                $client->send(json_encode(['type' => 'newOrder', 'order' => $order]));
            }
        }
    }
}

$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new OrderServer()
        )
    ),
    8080
);

$server->run();
