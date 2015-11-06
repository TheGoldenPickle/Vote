<?php
namespace Savion;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\Player;

class task extends PluginTask{
	public $player;
	public $no = $this->getOwner()->no;
	public $yes = $this->getOwner->yes;
	public function __construct(Plugin $owner, Player $player){
		parent::__construct($owner);
		$this->player = $player;
	}
	
	public function onRun($currentTick){
		if ($this->player instanceof Player){
			if (in_array($this->player->getName(), $this->getOwner()->voters)){
				$voters = array_search($this->player->getName(), $this->getOwner()->voters);
				unset($this->getOwner()->voters[$voters]);
				$this->getOwner()->getServer()->broadcastMessage("Vote has ended the polls are:");
				$this->getOwner()->getServer()->broadcastMessage("Yes:".count($this->yes));
				$this->getOwner()->getServer()->broadcastMessage("No:".count($this->no));
				$this->getOwner()->no = 0;
				$this->getOwner()->yes = 0;
				$this->getOwner()->openVotes = array();
				
				
			}
		}
	}
}
