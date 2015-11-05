<?php

use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
class Main extends PluginBase implements Listener{

public $voters = array();
public $votes = array();
public $server = $this->getServer();
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		@mkdir($this->getDataFolder());
		//loggers are for the poor
	}
	
	        
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
 if(strtolower($cmd->getName()) === "vote"){
  if(isset($args[0]) && isset($args[1])){
  $answer = $args[0];
  $voteid = $args[1];
  foreach($this->openVotes as $votes){
  if($answer === "no" && $voteid === $votes){
  if(in_array($this->voters,$sender->getName()){
  $sender->sendMessage("you voted ".$answer." on ".$votes."!");
  }else{
  $sender->sendMessage("there are no open votes!");
  }
  }
  }
  }
  }
   if(strtolower($cmd->getName()) === "newvote"){
   $question = implode(" ", $args);
   $this->server->broadcastMessage($sender->getName()." made a new vote called ".$question."! use /vote yes or no to choose your vote");
   }
   }
   }
  
  
