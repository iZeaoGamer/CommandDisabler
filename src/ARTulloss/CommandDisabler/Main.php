<?php

declare(strict_types=1);

namespace ARTulloss\CommandDisabler;

use pocketmine\plugin\PluginBase;

/**
 * Class Main
 * @package ARTulloss\CommandDisabler
 */
class Main extends PluginBase{

	private const UNKNOWN_COMMAND = TextFormat::colorize('Command "{command}" doesn\'t exist!');

	public function onEnable() : void{
		$this->saveDefaultConfig();
		$commands = $this->getConfig()->getAll();
		foreach ($commands as $commandName)
			if(!$this->disableCommand($commandName))
				$this->getLogger()->error(str_replace('{command}', $commandName, Main::UNKNOWN_COMMAND));
	}

	/**
	 * @param string $commandName
	 * @return bool
	 */
	public function disableCommand(string $commandName): bool
	{
		$map = $this->getServer()->getCommandMap();
		$command = $map->getCommand($commandName);
		if($command === null)
			return false;
		$map->unregister($command);
		return true;
	
				  }
}
 public function onPlayerCommand(PlayerCommandPreprocessEvent $event)
  {
    $name = $event->getPlayer()->getDisplayName();
    $playerIP = $event->getPlayer()->getAddress();
    $message = $event->getMessage();
	 $commands = $this->getConfig()->getAll();
		foreach ($commands as $commandName)
    if ($message[0] !== $this->disableCommand($commandName)) return;
    if ($this->disableCommand($commandName)){
        $event->setCancelled(true);
	    $event->getPlayer()->sendMessage(TextFormat::colorize("&cUnknown command."));
	}
    }
  }
