<?php declare(strict_types=1);
namespace Pejman\Agi\Command;
final class Link implements CommandInterface {
    public function __construct(private string $channel, private int $timeout = 60) {}
    public function getCommand(): string { return "BRIDGE {$this->channel}|{$this->timeout}"; }
    public function __toString(): string { return $this->getCommand(); }
}