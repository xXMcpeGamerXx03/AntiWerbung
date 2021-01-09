<?php

namespace AntiWerbung;

use AntiWerbung\commands\AntiWerbungCommand;
use AntiWerbung\listener\PlayerAdvertisementListener;
use AntiWerbung\listener\PlayerChatListener;
use AntiWerbung\listener\SignChangeListener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class AntiWerbung extends PluginBase {

    private static $instance;

    public function onEnable() {
        self::$instance = $this;
        $this->saveResource("domains.yml");
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents(new PlayerChatListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new SignChangeListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerAdvertisementListener(), $this);
        $this->getServer()->getCommandMap()->register("antiwerbung", new AntiWerbungCommand("antiwerbung", "Antiwerbung Command", "", ["aw", "aa"]));
    }

    public static function getInstance(): self {
        return self::$instance;
    }

    public static function getPrefix(): string {
        $cfg = new Config(self::getInstance()->getDataFolder() . "config.yml", 2);
        return $cfg->get("Prefix");
    }
}