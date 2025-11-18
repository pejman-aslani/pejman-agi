<?php declare(strict_types=1);
namespace Pejman\Agi\Command;
final class Wait implements CommandInterface {
    public function __construct(private float $seconds) {}
    public function getCommand(): string { return "WAIT {$this->seconds}"; }
    public function __toString(): string { return $this->getCommand(); }
}