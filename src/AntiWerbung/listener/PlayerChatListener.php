<?php

namespace AntiWerbung\listener;

use AntiWerbung\AntiWerbung;
use AntiWerbung\api\API;
use AntiWerbung\event\PlayerAdvertisementEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class PlayerChatListener implements Listener {

    public function onChat(PlayerChatEvent $chatEvent) {
        if (!$chatEvent->getPlayer()->hasPermission("antiwerbung.bypass")) {
            $message = $chatEvent->getMessage();
            foreach (API::getConfig()->getAll(true) as $value) {
                if (strpos($message, $value)) {
                    $chatEvent->setCancelled(true);
                    $event = new PlayerAdvertisementEvent($chatEvent->getPlayer(), $chatEvent->getMessage());
                    $event->call();
                }
            }
        }
    }
}
