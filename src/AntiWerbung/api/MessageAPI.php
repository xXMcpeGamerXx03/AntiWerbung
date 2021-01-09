<?php


namespace AntiWerbung\api;


use AntiWerbung\AntiWerbung;
use pocketmine\utils\Config;

class MessageAPI {

    public static function getString(string $message, array $params = null) {
        $cfg = new Config(AntiWerbung::getInstance()->getDataFolder() . "config.yml", 2);
        if ($params == null) {
            return AntiWerbung::getPrefix() . $cfg->get($message);
        } else {
            foreach ($params as $i => $param) {
                return AntiWerbung::getPrefix() . str_replace("{%$i}", $param, $cfg->get($message));
            }
        }
    }

    public static function getStringWithoutPrefix(string $message, array $params = null) {
        $cfg = new Config(AntiWerbung::getInstance()->getDataFolder() . "config.yml", 2);
        if ($params == null) {
            return $cfg->get($message);
        } else {
            foreach ($params as $i => $param) {
                return str_replace("{%$i}", $param, $cfg->get($message));
            }
        }
    }
}