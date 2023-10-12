<?php
    require_once('bingo_model.php');
    $bingoModel = new BingoModel();
    $result = $bingoModel->getBingoGames();
    echo $result;