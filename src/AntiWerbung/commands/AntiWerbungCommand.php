<?php


namespace AntiWerbung\commands;


use AntiWerbung\api\API;
use AntiWerbung\api\MessageAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class AntiWerbungCommand extends Command {

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("antiwerbung.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if ($sender->hasPermission($this->getPermission())) {
            if (isset($args[0])) {
                if ($args[0] == "add") {
                    if (isset($args[1])) {
                        if (API::domainExists($args[1]) == true) {
                            $sender->sendMessage(MessageAPI::getString("domain_already_exists"));
                            return true;
                        } else {
                            API::addDomain($args[1]);
                            $sender->sendMessage(MessageAPI::getString("domain_successfully_added", [$args[1]]));
                        }
                    } else {
                        $sender->sendMessage(MessageAPI::getString("no_args_add"));
                    }
                } else if ($args[0] == "remove") {
                    if (isset($args[1])) {
                        if (API::domainExists($args[1])) {
                            API::removeDomain($args[1]);
                            $sender->sendMessage(MessageAPI::getString("domain_successfully_removed", [$args[1]]));
                            return true;
                        } else {
                            $sender->sendMessage(MessageAPI::getString("domain_not_found"));
                        }
                    } else {
                        $sender->sendMessage(MessageAPI::getString("no_args_remove"));
                    }
                } else if ($args[0] == "list") {
                    if (empty(API::getConfig()->getAll(true))) {
                        $sender->sendMessage(MessageAPI::getString("no_domains_found"));
                        return true;
                    } else {
                        $list = array();
                        foreach (API::getConfig()->getAll(true) as $value) {
                            array_push($list, $value);
                        }
                        $sender->sendMessage(MessageAPI::getString("domains_message") . implode(MessageAPI::getStringWithoutPrefix("domains_separator"), $list));
                    }
                } else {
                    $sender->sendMessage(MessageAPI::getString("help_message"));
                }
            } else {
                $sender->sendMessage(MessageAPI::getString("help_message"));
            }
        } else {
            $sender->sendMessage(MessageAPI::getString("no_perms"));
        }
        return true;
    }
}