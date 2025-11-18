<?php declare(strict_types=1);
namespace Pejman\Agi\Command;
final class T38Gw implements CommandInterface {
    public function __construct(private string $options = 't38c', private ?string $channel = null) {}
    public function getCommand(): string {
        return 'T38 GATEWAY ' . ($this->channel ? "\"{$this->channel}\" " : '') . $this->options;
    }
    public function __toString(): string { return $this->getCommand(); }
}