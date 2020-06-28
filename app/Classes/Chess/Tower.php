<?php

namespace App\Classes\Chess;

use App\Classes\Chess\AbstractPiece;
use App\Classes\Chess\PieceInterface;

class Tower extends AbstractPiece implements PieceInterface
{
    public function __construct(string $player)
    {
        parent::__construct($player);
    }
    
    public function move(int $x, int $y)
    {
        Tower::$board[$y][$x] = $this;
        return true;
    }
}
