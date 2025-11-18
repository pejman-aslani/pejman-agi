<?php 
declare(strict_types=1);
namespace Pejman\Agi\Command;
final class ReceiveFile implements CommandInterface {
    public function __construct(private string $filename, private ?string $escapeDigits = null, private int $timeout = 0) {}
    public function getCommand(): string {
        $cmd = "RECEIVE FILE \"{$this->filename}\"";
        if ($this->escapeDigits !== null) $cmd .= " \"{$this->escapeDigits}\"";
        if ($this->timeout > 0) $cmd .= " {$this->timeout}";
        return $cmd;
    }
    public function __toString(): string { return $this->getCommand(); }
}