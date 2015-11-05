<?php
namespace Savion;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\Player;

class task extends PluginTask{
	public $player;
	public function __construct(Plugin $owner, Player $player){
		parent::__construct($owner);
		$this->player = $player;
	}
	
	public function onRun($currentTick){
		if ($this->player instanceof Player){
			if (in_array($this->player->getName(), $this->getOwner()->voters)){
				$voters = array_search($this->player->getName(), $this->getOwner()->voters);
				unset($this->getOwner()->voters[$voters]);
				$this->getOwner()->no = 0;
				$this->getOwner()->yes = 0;
				
			}
		}
	}
}
