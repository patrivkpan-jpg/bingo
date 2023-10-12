<?php
    require('controllers/bingo.php');
?>
<!DOCTYPE html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>

    <link rel="stylesheet" href="resources/css/main.css">
</head>
<html>
    <body>
        <h1>Bingo Game!</h1>
        <input id='enter_name_input' type='text' placeholder="Please enter your name..."><button id='enter_name_btn'>Enter</button>
        <div class='bingo-container'>
            <div>
                <table id='bingo_table'>
                    <h2 id='bingo_card_header'>Your bingo card</h2>
                    <tbody>
                        <tr>
                            <th>B</th>
                            <th>I</th>
                            <th>N</th>
                            <th>G</th>
                            <th>O</th>
                        </tr>
                    </tbody>
                </table>
                <button id='next_turn_btn'>Next Turn!</button>
            </div>
            <div>
                <h2>Picked Bingo Pairs!</h2>
                <ul class='bingo-pair-list'>

                </ul>
            </div>
        </div>
        <a href='/bingo/history.php'>Check out the previous games!</a>
    </body>
</html>