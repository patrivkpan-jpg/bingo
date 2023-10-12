<?php
    require_once('bingo_model.php');
    $bingoModel = new BingoModel();
    $bingoModel->insertBingoGame($_POST['player'], $_POST['startDatetime'], $_POST['numberOfTurns']);