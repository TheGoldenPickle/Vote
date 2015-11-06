<?php

namespace Savion;

use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener{

public $voters = array();
public $no = 0;
public $yes = 0;
public $openVotes = array();
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		@mkdir($this->getDataFolder());
		//loggers are for the poor
	}
	
	        
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
 if(strtolower($cmd->getName()) === "vote"){
  if(isset($args[0]) && isset($args[1])){
  $answer = $args[0];
  if($answer === null){
  	$sender->sendMessage("usage: /vote (yes) or (no)");
  	return false;
  }
  
  foreach($this->openVotes as $votes){
  if($answer === "no"){
  if(in_array($this->voters,$sender->getName()){
  $sender->sendMessage("you voted ".$answer." on ".$votes."!");
  $this->updateNo();
  return true;
  }else{
  $sender->sendMessage("there are no open votes!");
  return false;
  }
  }
  
  if($answer === "yes"){
  if(in_array($this->voters,$sender->getName()){
  $sender->sendMessage("you voted ".$answer." on ".$votes."!");
  $this->updateYes();
  return true;
  }else{
  $sender->sendMessage("there are no open votes!");
  return false;
  }
  }
  }
  
  }
  
 }
  
   if(strtolower($cmd->getName()) === "newvote"){
   	if(!in_array($this->voters,$sender->getName())){
   $question = implode(" ", $args);
   foreach($this->getServer()->getOnlinePlayers() as $onlinep){
   $this->getServer()->broadcastMessage($sender->getName()." made a new vote called ".$question."! use /vote yes or no to choose your vote");
   $this->addVote($sender,$question);
  array_push($this->voters,$onlinep);
  $task = new task($this, $onlinep);
  $this->getServer()->getScheduler()->scheduleDelayedTask($task, 20*60);
   }
   
   }else{
   	$sender->sendMessage("There is already an open vote!");
   	return false;
   }
   return true;
}
}

public function addVote(Player $p1,$question){
	$this->openVotes[$p1->getName()]=
	array("Question"=> $question);
}

public function updateNo(){
	$this->no + 1;
}

public function updateYes(){
$this->yes + 1;
}

}
