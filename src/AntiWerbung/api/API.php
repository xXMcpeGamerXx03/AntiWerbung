<?php

namespace AntiWerbung\api;

use AntiWerbung\AntiWerbung;
use pocketmine\utils\Config;

class API {

    public static function addDomain(string $domain) {
        $cfg = self::getConfig();
        $cfg->set($domain, true);
        $cfg->save();
    }

    public static function removeDomain(string $domain) {
        $cfg = self::getConfig();
        $cfg->remove($domain);
        $cfg->save();
    }

    public static function getConfig() {
        return new Config(AntiWerbung::getInstance()->getDataFolder() . "domains.yml", 2);
    }

    public static function domainExists(string $domain): bool {
        $cfg = self::getConfig();
        if ($cfg->exists($domain)) {
            return true;
        }
        return false;
    }
}