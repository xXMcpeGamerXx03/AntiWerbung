<?php


namespace AntiWerbung\event;


use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerAdvertisementEvent extends PlayerEvent {

    protected $player, $message;

    public function __construct(Player $player, string $message) {
        $this->player = $player;
        $this->message = $message;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}