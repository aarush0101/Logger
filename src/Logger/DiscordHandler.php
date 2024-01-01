<?php

namespace Logger;

use pocketmine\utils\TextFormat as TF;
use src\Logger\Config;
class DiscordHandler {

    private $webhookUrl;
    private $main;

    public function __construct(string $webhookUrl, Main $main) {
        $this->webhookUrl = $webhookUrl;
        $this->main = $main;
    }

    public function sendToDiscord(string $eventType, string $message, string $server) {
        $embedColor = $this->getEmbedColor($eventType);
        $data = [
            "embeds" => [
                [
                    "title" => $server,
                    "description" => $message,
                    "color" => $embedColor,
                ],
            ],
        ];

        $options = [
            "http" => [
            "header" => "Content-Type: application/json",
            "method" => "POST",
            "content" => json_encode($data),
        ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($this->webhookUrl, false, $context);

        if ($result === false) {
            $this->main->getLogger()->warning("Failed to send message to Discord!");
        }
    }

    public function sendToDiscord2(string $eventType, string $message) {
        $embedColor = $this->getEmbedColor($eventType);
        $config_path = dirname(__FILE__) . '/../../config.yml';
        $config = yaml_parse_file($config_path);
        $server_name = $config['server_name'];
        $data = [
            "embeds" => [
                [
                    "title" => $server_name,
                    "description" => $message,
                    "color" => $embedColor,
                ],
            ],
        ];

        $options = [
            "http" => [
            "header" => "Content-Type: application/json",
            "method" => "POST",
            "content" => json_encode($data),
        ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($this->webhookUrl, false, $context);

        if ($result === false) {
            $this->main->getLogger()->warning("Failed to send message to Discord!");
        }
    }

    private function getEmbedColor(string $eventType): int {
            $config_path = dirname(__FILE__) . '/../../config.yml';
            $config = yaml_parse_file($config_path);
    
            switch ($eventType) {
                case "joins":
                    return $config["joins_color"];
                case "leaves":
                    return $config["leaves_color"];
                case "chat":
                    return $config["chats_color"];
                case "on":
                    return $config['server_on_color'];
                case "off":
                    return $config['server_off_color'];
                default:
                    return $config["default_color"];
        };
    }
}
