<?php

namespace App\Classes\Chess;

abstract class AbstractPiece
{
    /**
     * @var string $player Player name
     */
    protected $player;

    /**
     * @var array<array<AbstractPiece>> $board chest board
     */
    public static $board;

    public function __construct(string $player)
    {
        $this->player = $player;
    }

    /**
     * Getter player
     *
     * @return string
     */
    public function getPlayer(): string
    {
        return $this->player;
    }

    /**
     * Setter player
     */
    public function setPlayer(string $player): void
    {
        $this->player = $player;
    }

    // /**
    //  * Getter board
    //  */
    // public function getBoard(): array
    // {
    //     return self::$board;
    // }

    // /**
    //  * Setter board
    //  */
    // public function setBoard(array $board)
    // {
    //     self::$board = $board;
    // }
}
