<?php

declare(strict_types=1);

namespace Pejman\Agi;

use Pejman\Agi\Command\{
    Answer,
    Hangup,
    StreamFile,
    SayDigits,
    SayNumber,
    GetData,
    WaitForDigit,
    SetVariable,
    GetVariable,
    DatabaseGet,
    DatabasePut,
    DatabaseDel,
    Exec,
    GetOption,
    RecordFile,
    GetFullVariable,
    ChannelStatus,
    SetCallerId,
    SetMute,
    Dial,
    SendText,
    Agi as AgiCommand,
    CommandInterface,
    Link,
    ReceiveChar,
    Wait,
    SetPriority,
    SetAgiText,
    Gosub,
    T38Gw,
    StopPlayback,
    ReceiveFile
};
use Pejman\Agi\Tts\PiperTts;
use Pejman\src\Command\GetOption as CommandGetOption;
use Pejman\src\Command\SendText as CommandSendText;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class Client
{
    private mixed $input;
    private mixed $output;
    private ?PiperTts $tts = null;
    private array $environment = [];

    public function __construct(
        mixed $input = null,
        mixed $output = null,
        private readonly ?LoggerInterface $logger = null,
    ) {
        $this->logger ??= new NullLogger();

        $this->input  = $input  ?? fopen('php://stdin', 'r');
        $this->output = $output ?? fopen('php://stdout', 'w');

        if (!is_resource($this->input) || get_resource_type($this->input) !== 'stream') {
            throw new Exception\AgiException('Invalid input stream');
        }
        if (!is_resource($this->output) || get_resource_type($this->output) !== 'stream') {
            throw new Exception\AgiException('Invalid output stream');
        }

        stream_set_blocking($this->input, false);
        $this->readEnvironment();
    }

    private function readEnvironment(): void
    {
        while (($line = fgets($this->input)) !== false) {
            $line = trim($line);
            if ($line === '') {
                break;
            }
            if (!str_contains($line, ':')) {
                continue;
            }
            [$key, $value] = explode(':', $line, 2);
            $this->environment[trim($key)] = trim($value);
        }
        $this->logger->debug('AGI Environment loaded', ['vars' => $this->environment]);
    }

    public function getEnvironment(string $key, ?string $default = null): ?string
    {
        return $this->environment[$key] ?? $default;
    }

    public function getCallerId(): ?string
    {
        return $this->getEnvironment('agi_callerid');
    }

    public function getChannel(): ?string
    {
        return $this->getEnvironment('agi_channel');
    }

    public function execute(CommandInterface $command): Response
    {
        $raw = (string)$command . "\n";
        $this->logger->debug('→ AGI', ['command' => trim($raw)]);

        if (fwrite($this->output, $raw) === false || fflush($this->output) === false) {
            throw new Exception\AgiException('Failed to send AGI command');
        }

        $firstLine = fgets($this->input, 4096) ?: '';
        if ($firstLine === '') {
            throw new Exception\AgiException('No response from Asterisk (hangup?)');
        }

        $full = rtrim($firstLine);
        while (($next = fgets($this->input, 4096)) !== false) {
            $next = rtrim($next);
            if ($next === '' || preg_match('/^\d{3} /', $next)) {
                if ($next !== '') $full .= "\n" . $next;
                break;
            }
            $full .= "\n" . $next;
        }

        $this->logger->debug('← AGI Response', ['response' => $full]);
        return Response::fromRaw($firstLine, $full);
    }


    public function answer(): Response
    {
        return $this->execute(new Answer());
    }
    public function hangup(?string $channel = null): Response
    {
        return $this->execute(new Hangup($channel));
    }
    public function streamFile(string $filename, string $escapeDigits = '', int $offset = 0): Response
    {
        return $this->execute(new StreamFile($filename, $escapeDigits, $offset));
    }
    public function sayDigits(int $number, string $escapeDigits = ''): Response
    {
        return $this->execute(new SayDigits($number, $escapeDigits));
    }
    public function sayNumber(int $number, string $escapeDigits = ''): Response
    {
        return $this->execute(new SayNumber($number, $escapeDigits));
    }
    public function getData(string $filename, ?int $timeout = null, ?int $maxDigits = null): Response
    {
        return $this->execute(new GetData($filename, $timeout, $maxDigits));
    }
    public function waitForDigit(int $timeout = -1): Response
    {
        return $this->execute(new WaitForDigit($timeout));
    }
    public function setVariable(string $variable, string|int|float $value): Response
    {
        return $this->execute(new SetVariable($variable, $value));
    }
    public function getVariable(string $variable): Response
    {
        return $this->execute(new GetVariable($variable));
    }
    public function databaseGet(string $family, string $key): Response
    {
        return $this->execute(new DatabaseGet($family, $key));
    }
    public function databasePut(string $family, string $key, string $value): Response
    {
        return $this->execute(new DatabasePut($family, $key, $value));
    }
    public function databaseDel(string $family, string $key): Response
    {
        return $this->execute(new DatabaseDel($family, $key));
    }
    public function exec(string $application, string|array $options = []): Response
    {
        return $this->execute(new Exec($application, $options));
    }
    public function getOption(string $filename, string $escapeDigits, int $timeout = -1): Response
    {
        return $this->execute(new CommandGetOption($filename, $escapeDigits, $timeout));
    }
    public function recordFile(string $filename, string $format, string $escapeDigits = '', int $timeout = -1, bool $beep = false, int $silence = 0): Response
    {
        return $this->execute(new RecordFile($filename, $format, $escapeDigits, $timeout, $beep, $silence));
    }
    public function getFullVariable(string $variable, ?string $channel = null): Response
    {
        return $this->execute(new GetFullVariable($variable, $channel));
    }
    public function channelStatus(?string $channel = null): Response
    {
        return $this->execute(new ChannelStatus($channel));
    }
    public function setCallerId(string $callerId): Response
    {
        return $this->execute(new SetCallerId($callerId));
    }
    public function setMute(bool $status): Response
    {
        return $this->execute(new SetMute($status));
    }
    public function pause(int $milliseconds): Response
    {
        return $this->waitForDigit($milliseconds);
    }
    public function dial(string $destination, int $timeout = 60, string $options = 'tr'): Response
    {
        return $this->execute(new Dial($destination, $timeout, $options));
    }
    public function sendText(string $text): Response
    {
        return $this->execute(new CommandSendText($text));
    }
    public function callAgi(string $uri): Response
    {
        return $this->execute(new AgiCommand($uri));
    }
    public function linkChannels(string $channelToLink, int $timeout = 60): Response
    {
        return $this->execute(new Link($channelToLink, $timeout));
    }
    public function receiveChar(int $timeout = 0): Response
    {
        return $this->execute(new ReceiveChar($timeout));
    }
    public function wait(float $seconds): Response
    {
        return $this->execute(new Wait($seconds));
    }
    public function setPriority(string $priority): Response
    {
        return $this->execute(new SetPriority($priority));
    }
    public function setAgiText(string $text): Response
    {
        return $this->execute(new SetAgiText($text));
    }
    public function gosub(string $context, string $extension, string $priority = '1', string $args = ''): Response
    {
        return $this->execute(new Gosub($context, $extension, $priority, $args));
    }
    public function t38Gw(string $options = 't38c', ?string $channel = null): Response
    {
        return $this->execute(new T38Gw($options, $channel));
    }
    public function stopPlayback(): Response
    {
        return $this->execute(new StopPlayback());
    }
    public function receiveFile(string $filename, ?string $escapeDigits = null, int $timeout = 0): Response
    {
        return $this->execute(new ReceiveFile($filename, $escapeDigits, $timeout));
    }

    // =================================================================
    // TTS لوکال فارسی با Piper (بهترین صدای دنیا!)
    // =================================================================
    private function getTts(): PiperTts
    {
        return $this->tts ??= new PiperTts();
    }

    public function sayText(string $text, string $escapeDigits = '', array $options = []): Response
    {
        $text = trim($text);
        if ($text === '') {
            return new Response(200, 0, 'empty text');
        }

        $wavPath = $this->getTts()->synthesize($text, $options);
        $filename = 'custom/agi_' . basename($wavPath, '.wav');
        $targetPath = '/var/lib/asterisk/sounds/fa/' . $filename . '.wav';

        if (!file_exists($targetPath)) {
            if (!@copy($wavPath, $targetPath)) {
                throw new Exception\AgiException("Cannot copy TTS file to Asterisk sounds directory");
            }
        }

        return $this->streamFile($filename, $escapeDigits);
    }
}
