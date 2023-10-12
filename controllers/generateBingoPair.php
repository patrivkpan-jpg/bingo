<?php
    require_once('bingo.php');
    $bingo = new Bingo();
    $result = [
        'pickedBingoPairs'    => $bingo->getPickedBingoPairs(),
        'newBingoPair'        => $bingo->getNewBingoPair(),
        'allBingoPairsPicked' => $bingo->getAllBingoPairsPicked()
    ];
    echo json_encode($result);