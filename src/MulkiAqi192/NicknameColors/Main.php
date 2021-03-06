<?php

namespace MulkiAqi192\NicknameColors;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

	public function onEnable(): void{
	    @mkdir($this->getDataFolder());
	    $this->saveDefaultConfig();
	    $this->getResource("config.yml");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
		switch($command->getName()){
			case "ncolors":
				if($sender instanceof Player){
					if($sender->hasPermission("ncolors.use")){
						if($this->getConfig()->get("form-api-usage") == "true"){
						    $this->ncolors($sender);

                        } else {
						    if(!isset($args[0])){
						        $sender->sendMessage("§7[§aNickname§6Colors§7]§f §eList of NicknameColors commands:\n §9/ncolors list - §aShows colors list\n§9 /ncolors use [color] - §aChange your nickname color");
						        return true;
                            } else {
						        if(strtolower($args[0]) == "list"){
						            $sender->sendMessage("§7[§aNickname§6Colors§7]§f §eList of Nickname Colors:\n §f• §fWhite\n §f• §cRed\n §f• §bBlue\n §f• §eYellow\n §f• §6Orange\n §f• §dPurple");
                                }
						        if(strtolower($args[0]) == "use"){
						            if(!isset($args[1])){
						                $sender->sendMessage("§7[§aNickname§6Colors§7]§f §cPlease use: §9/ncolors use [colorname]");
						                return true;
                                    } else {
						                switch(strtolower($args[1])){
                                            case "white":
                                                $sender->setDisplayName("§f" . $sender->getName() . "§f");
                                                $sender->setNameTag("§f" . $sender->getName() . "§f");
                                                $sender->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to §fWhite!");
                                                break;

                                            case "red":
												if ($sender->hasPermission("red.ncolors")){
													$sender->setDisplayName("§c" . $sender->getName() . "§f");
													$sender->setNameTag("§c" . $sender->getName() . "§f");
													$sender->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to §cRed!");
												} else {
													$sender->sendMessage($this->getConfig()->get("no-permission-using-this-color"));
												}
												break;

                                            case "blue":
												if ($sender->hasPermission("blue.ncolors")){
													$sender->setDisplayName("§b" . $sender->getName() . "§f");
													$sender->setNameTag("§b" . $sender->getName() . "§f");
													$sender->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to §bBlue!");
												} else {
													$sender->sendMessage($this->getConfig()->get("no-permission-using-this-color"));
												}
												break;

                                            case "yellow":
                                               if ($sender->hasPermission("yellow.ncolors")){
												   $sender->setDisplayName("§e" . $sender->getName() . "§f");
												   $sender->setNameTag("§e" . $sender->getName() . "§f");
												   $sender->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to Yellow!");
											   } else {
												   $sender->sendMessage($this->getConfig()->get("no-permission-using-this-color"));
											   }
											   break;

                                            case "orange":
                                               if ($sender->hasPermission("orange.ncolors")){
												   $sender->setDisplayName("§6" . $sender->getName() . "§f");
												   $sender->setNameTag("§6" . $sender->getName() . "§f");
												   $sender->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to §6Orange!");
											   } else {
												   $sender->sendMessage($this->getConfig()->get("no-permission-using-this-color"));
											   }
                                                break;

                                            case "purple":
                                                if ($sender->hasPermission("purple.ncolors")){
													$sender->setDisplayName("§d" . $sender->getName() . "§f");
													$sender->setNameTag("§d" . $sender->getName() . "§f");
													$sender->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to §dPurple!");
												} else {
													$sender->sendMessage($this->getConfig()->get("no-permission-using-this-color"));
												}
                                                break;
                                        }
                                    }
                                }
                            }

                        }
					} else {
						$sender->sendMessage($this->getConfig()->get("no-permission-command"));
					}
				} else {
					$sender->sendMessage($this->getConfig()->get("cmd-not-player"));
				}
		}
	return true;
	}

	public function ncolors(Player $player){
		$form = new SimpleForm(function (Player $player, $data = null){
			if($data === null){
				return true;
			}
			switch($data){
				case 0:
					$player->setDisplayName("§f" . $player->getName() . "§f");
					$player->setNameTag("§f" . $player->getName() . "§f");
					$player->sendMessage("§7[§aNickname§6Colors§7]§f §enickname color has been changed to §fWhite!");
				break;

				case 1:
					$player->setDisplayName("§c" . $player->getName() . "§f");
					$player->setNameTag("§c" . $player->getName() . "§f");
					$player->sendMessage("§7[§aNickname§6Colors§7]§f §eYour nickname color has been changed to §cRed!");
				break;

				case 2:
					$player->setDisplayName("§b" . $player->getName() . "§f");
					$player->setNameTag("§b" . $player->getName() . "§f");
					$player->sendMessage("§7[§aNickname§6Colors§7]§f §eYour nickname color has been changed to §bBlue!");
				break;

				case 3:
					$player->setDisplayName("§e" . $player->getName() . "§f");
					$player->setNameTag("§e" . $player->getName() . "§f");
					$player->sendMessage("§7[§aNickname§6Colors§7]§f §eYour nickname color has been changed to §eYellow!");
				break;

				case 4:
					$player->setDisplayName("§6" . $player->getName() . "§f");
					$player->setNameTag("§6" . $player->getName() . "§f");
					$player->sendMessage("§7[§aNickname§6Colors§7]§f §eYour nickname color has been changed to §6Orange!");
				break;

				case 5:
					$player->setDisplayName("§d" . $player->getName() . "§f");
					$player->setNameTag("§d" . $player->getName() . "§f");
					$player->sendMessage("§7[§aNickname§6Colors§7]§f §eYour nickname color has been changed to §dPurple!");
				break;
			}
		return true;
		});
		$form->setTitle("§aNickname §6Colors");
		$form->setContent("§9>> §eSelect your color you prefer to your nickname!");
		$form->addButton("White");
		$form->addButton("§cRed");
		$form->addButton("§bBlue");
		$form->addButton("§eYellow");
		$form->addButton("§6Orange");
		$form->addButton("§dPurple");
		$form->sendToPlayer($player);
		return $form;
	}

}
