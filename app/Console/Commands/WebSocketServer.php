<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSockets\WebSocketHandlers;
class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:serve';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */

     protected $description = 'Start the WebSocket server';


    public function handle()
    {
        $this->info('WebSocket server started on port 8080');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketHandlers()
                )
            ),
            8080
        );
        $server->run();
    }
}
