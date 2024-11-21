<?php

class Logger
{
    private $format;
    private $delivery;

    public function __construct(Format $format, Deliver $delivery)
    {
        $this->format = $format;
        $this->delivery = $delivery;
    }

    public function log($string): void
    {
        $this->delivery->deliver($this->format->format($string));
    }
}

class RawFormat implements Format
{
    public function format($string): string
    {
        return $string;
    }
}

class WithDateFormat implements Format
{
    public function format($string): string
    {
        return date('Y-m-d H:i:s') . $string;
    }
}

class WithDateAndDetailsFormat implements Format
{
    public function format($string): string
    {
        return date('Y-m-d H:i:s') . $string . ' - With some details';
    }
}

interface Format
{
    public function format($string): string;
}

class ByEmailDeliver implements Deliver
{
    public function deliver($format): void
    {
        echo "Вывод формата ({$format}) по имейл";
    }
}

class BySmsDeliver implements Deliver
{
    public function deliver($format): void
    {
        echo "Вывод формата ({$format}) в смс";
    }
}

class ToConsoleDeliver implements Deliver
{
    public function deliver($format): void
    {
        echo "Вывод формата ({$format}) в консоль";
    }
}

interface Deliver
{
    public function deliver($format): void;
}

$logger = new Logger(new RawFormat(), new BySmsDeliver());
$logger->log('Emergency error! Please fix me!');
