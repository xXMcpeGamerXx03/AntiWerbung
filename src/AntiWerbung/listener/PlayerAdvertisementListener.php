<?php

namespace AntiWerbung\listener;

use AntiWerbung\api\MessageAPI;
use AntiWerbung\event\PlayerAdvertisementEvent;
use pocketmine\event\Listener;

class PlayerAdvertisementListener implements Listener {

    public function onAdvertisement(PlayerAdvertisementEvent $advertisementEvent) {
        $advertisementEvent->getPlayer()->sendMessage(MessageAPI::getString("player_dont_use_domain_message"));
        foreach ($advertisementEvent->getPlayer()->getServer()->getOnlinePlayers() as $player) {
            if ($player->hasPermission("antiwerbung.notify")) {
                $player->sendMessage(MessageAPI::getString("player_use_domain_notify_msg1"));
                $player->sendMessage(MessageAPI::getString("player_use_domain_notify_msg2", [$advertisementEvent->getPlayer()->getName()]));
                $player->sendMessage(MessageAPI::getString("player_use_domain_notify_msg3", [$advertisementEvent->getMessage()]));
            }
        }
    }
}