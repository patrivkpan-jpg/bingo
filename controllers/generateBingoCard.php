<?php
    require_once('bingo.php');
    $bingo = new Bingo();
    $card = $bingo->getCard();

    $numbersForDisplay = array_merge(...array_map(null, ...(array_values($card))));
    $result = [
        'numbersForDisplay' => $numbersForDisplay,
        'card'              => $card
    ];
    echo json_encode($result);