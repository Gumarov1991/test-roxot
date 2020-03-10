<?php
namespace App\Entity;

class Player
{
    private const PLAY_PLAY_STATUS = 'play';
    private const BENCH_PLAY_STATUS = 'bench';

    private int $number;
    private string $name;
    private string $playStatus;
    private int $inMinute;
    private int $inMatchTime;
    private string $position;
    private bool $isScoredGoal;
    private array $cards;

    public function __construct(int $number, string $name, string $position)
    {
        $this->number = $number;
        $this->name = $name;
        $this->position = $position;
        $this->playStatus = self::BENCH_PLAY_STATUS;
        $this->inMinute = 0;
        $this->inMatchTime = 0;
        $this->isScoredGoal = false;
        $this->cards = [];
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getInMinute(): int
    {
        return $this->inMinute;
    }

    public function getInMatchTime(): int
    {
        return $this->inMatchTime;
    }

    public function isPlay(): bool
    {
        return $this->playStatus === self::PLAY_PLAY_STATUS;
    }

    public function getPlayTime(): int
    {
        return $this->inMatchTime;
    }

    public function goToPlay(int $minute): void
    {
        $this->inMinute = $minute;
        $this->playStatus = self::PLAY_PLAY_STATUS;
    }

    public function goToBench(int $minute, bool $isReplace = false): void
    {
        $extraOneMinute = $isReplace ? 0 : 1;

        $this->inMatchTime += $minute - $this->inMinute + $extraOneMinute;
        $this->playStatus = self::BENCH_PLAY_STATUS;
    }

    public function scoreGoal(): void
    {
        $this->isScoredGoal = true;
    }

    public function isScoredGoal(): bool
    {
        return $this->isScoredGoal;
    }

    public function recievedCard(string $typeOfCard): void
    {
        $this->cards[] = $typeOfCard;
    }

    public function getCards(): array
    {
        return $this->cards;
    }
}