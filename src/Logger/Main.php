<?php

namespace Logger;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener {

    private $discordHandler;

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $config_path = dirname(__FILE__) . '/../../config.yml';
        $config = yaml_parse_file($config_path);
        $webhookUrl = $config['webhook'];
        $this->discordHandler = new DiscordHandler($webhookUrl, $this);
        $this->discordHandler->sendToDiscord2("on", "The server has started.");
        $this->getLogger()->info(TF::GREEN . "Logger plugin enabled!");
    }

    public function onDisable() : void {    
        $config_path = dirname(__FILE__) . '/../../config.yml';
        $config = yaml_parse_file($config_path);
        $webhookUrl = $config['webhook'];
        $this->discordHandler = new DiscordHandler($webhookUrl, $this);
        $this->discordHandler->sendToDiscord2("off", "The server has shut down.");
        $this->getLogger()->info(TF::RED . "Logger plugin disabled!");
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $servername = $player->getServer();
        $server = $servername->getName();
        $this->discordHandler->sendToDiscord("joins", "[+] " . $player->getName(), $server);
    }

    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $servername = $player->getServer();
        $server = $servername->getName();
        $this->discordHandler->sendToDiscord("leaves", "[-] " . $player->getName(), $server);
    }

    public function onChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();
        $message = $event->getMessage();
        $servername = $player->getServer();
        $server = $servername->getName();
        $formattedMessage = $player->getName() . ": " . $message;
        $this->discordHandler->sendToDiscord("chat", $formattedMessage, $server);
    }
}
