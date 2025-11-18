<?php declare(strict_types=1);
namespace Pejman\Agi\Command;
final class StopPlayback implements CommandInterface {
    public function getCommand(): string { return 'STOP PLAYBACK'; }
    public function __toString(): string { return $this->getCommand(); }
}