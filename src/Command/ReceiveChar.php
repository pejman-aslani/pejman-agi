<?php declare(strict_types=1);
namespace Pejman\Agi\Command;
final class ReceiveChar implements CommandInterface {
    public function __construct(private int $timeout = 0) {}
    public function getCommand(): string { return "RECEIVE CHAR {$this->timeout}"; }
    public function __toString(): string { return $this->getCommand(); }
}