<?php

namespace App\Classes\Chess;

interface PieceInterface
{
    public function move(int $x, int $y);
}
