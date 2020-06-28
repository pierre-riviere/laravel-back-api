<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Classes\Chess\Tower;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a tower piece for the player A
        $towerA = new Tower('A');

        // create a tower piece for the player A
        $towerB = new Tower('B');

        // create board Y * X (8 * 8 boxes)
        Tower::$board = array_fill(0, 8, array_fill(0, 8, null));

        // place the tower piece on the chess board
        Tower::$board[1][3] = $towerA;
        Tower::$board[7][6] = $towerB;

        // draw initial chess board
        $this->drawChessBoard();

        // player A move his tower piece
        if ((Tower::$board[1][3])->move(7, 1)) {
            $piece = Tower::$board[1][3];
            Tower::$board[1][3] = null;
            echo 'Player ' . $piece->getPlayer() . " moved " . $this->getShortClassName($piece) . " <br/>";
        } else {
        }
        

        // draw chess board after a moved piece
        $this->drawChessBoard();
        
        return null;
    }

    /**
     * Draw the chess board
     */
    private function drawChessBoard()
    {
        $maxChar = 5; // max char to print per box

        for ($i = 7; $i >= 0; $i--) {
            for ($j = 0; $j <= 7; $j++) {
                $piece = Tower::$board[$i][$j];
                $pieceName = !isset($piece) ? "[" . implode(array_fill(0, $maxChar, "_")) . "] " : $this->getShortClassName($piece) . $piece->getPlayer();
                echo $pieceName;
            }
            echo '<br/>';
        }
    }

    /**
     * Get short name of the given class object
     * Namespace removed
     *
     * @param object
     * @return string
     */
    private function getShortClassName(Object $object)
    {
        return substr(strrchr(get_class($object), '\\'), 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
