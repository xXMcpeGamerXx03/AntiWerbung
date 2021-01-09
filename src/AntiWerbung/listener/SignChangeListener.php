<?php

namespace AntiWerbung\listener;

use AntiWerbung\api\API;
use AntiWerbung\event\PlayerAdvertisementEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\Listener;

class SignChangeListener implements Listener {

    public function onSignChange(SignChangeEvent $changeEvent) {
        if (!$changeEvent->getPlayer()->hasPermission("antiwerbung.bypass")) {
            foreach (API::getConfig()->getAll(true) as $value) {
                if (strpos($changeEvent->getLine(0), $value)) {
                    $changeEvent->setCancelled(true);
                    $event = new PlayerAdvertisementEvent($changeEvent->getPlayer(), $changeEvent->getLine(0));
                    $event->call();
                } else if (strpos($changeEvent->getLine(1), $value)) {
                    $changeEvent->setCancelled(true);
                    $event = new PlayerAdvertisementEvent($changeEvent->getPlayer(), $changeEvent->getLine(1));
                    $event->call();
                } else if (strpos($changeEvent->getLine(2), $value)) {
                    $changeEvent->setCancelled(true);
                    $event = new PlayerAdvertisementEvent($changeEvent->getPlayer(), $changeEvent->getLine(2));
                    $event->call();
                } else if (strpos($changeEvent->getLine(3), $value)) {
                    $changeEvent->setCancelled(true);
                    $event = new PlayerAdvertisementEvent($changeEvent->getPlayer(), $changeEvent->getLine(3));
                    $event->call();
                }
            }
        }
    }
}