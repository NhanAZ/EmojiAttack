<?php

declare(strict_types=1);

namespace NhanAZ\EmojiAttack;

use pocketmine\utils\Config as ๐;
use pocketmine\event\Listener as ๐;
use pocketmine\utils\TextFormat as ๐;
use pocketmine\plugin\PluginBase as ๐ ;
use pocketmine\event\server\DataPacketSendEvent as ๐ณ๏ธ;
use pocketmine\network\mcpe\protocol\TextPacket as ๐ฌ;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket as ๐ฆ;
use function array_rand as ๐ฐ;
use function preg_replace as ๐;

define("โ๏ธ", true);
define("โ", false);

class ๐ extends ๐  implements ๐ {

	protected const โ๏ธ = ๐::ESCAPE . "\u{3000}";
	protected ๐ $๐;

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		/** Mom, Look! It works! ๐ฑ */
		$this->saveDefaultConfig();
		$this->saveResource("๐.txt");
		$this->๐ = new ๐($this->getDataFolder() . "๐.txt", ๐::ENUM);
	}

	private function ๐ฐ(): string {
		$๐ช = $this->๐->getAll(โ๏ธ);
		return " " . $๐ช[๐ฐ($๐ช)] . self::โ๏ธ;
	}

	public function ๐ค(string $๐): string {
		$๐ฅ = "/%*(([a-z0-9_]+\.)+[a-z0-9_]+)/i";
		$๐ง = "%$1";
		if ($this->getConfig()->get("randomColor")) {
			$๐ณ๏ธโ๐ = $this->getConfig()->get("arrColor", ["ยงe", "ยงa", "ยงd", "ยงc", "ยงb"]);
			return ๐($๐ฅ, $๐ง, $๐) .  $๐ณ๏ธโ๐[๐ฐ($๐ณ๏ธโ๐)] . $this->๐ฐ();
		} else {
			return ๐($๐ฅ, $๐ง, $๐) . $this->๐ฐ();
		}
	}

	public function ๐(๐ณ๏ธ $๐): void {
		foreach ($๐->getPackets() as $โ => $โจ) {
			if ($โจ instanceof ๐ฌ) {
				switch ($โจ->type) {
					case ๐ฌ::TYPE_POPUP:
					case ๐ฌ::TYPE_JUKEBOX_POPUP:
					case ๐ฌ::TYPE_TIP:
						break;
					case ๐ฌ::TYPE_TRANSLATION:
						$โจ->message = $this->๐ค($โจ->message);
						break;
					default:
						if ($this->getConfig()->get("randomColor")) {
							$๐ณ๏ธโ๐ = $this->getConfig()->get("arrColor", ["ยงe", "ยงa", "ยงd", "ยงc", "ยงb"]);
							$โจ->message .= $๐ณ๏ธโ๐[๐ฐ($๐ณ๏ธโ๐)] . $this->๐ฐ();
						} else {
							$โจ->message .= $this->๐ฐ();
						}
						break;
				}
			} elseif ($โจ instanceof ๐ฆ) {
				foreach ($โจ->commandData as $๐ => $๐) {
					$๐->description = $this->๐ค($๐->description);
				}
			}
		}
	}
}
