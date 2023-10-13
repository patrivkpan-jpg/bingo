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
        <div id='start_game_components'>
            <div class='enter-name-input-cont'>
                <input id='enter_name_input' type='text' placeholder="Please enter your name...">
            </div>
            <div class='enter-name-btn-cont'>
                <button id='enter_name_btn'>Enter</button>
            </div>
        </div>
        <div class='bingo-container'>
            <div class='bingo-card-container'>
                <table id='bingo_table'>
                    <tbody>
                        <tr class='bingo-letters'>
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
            <div class='bingo-pair-list-container'>
                <ul class='bingo-pair-list'>

                </ul>
            </div>
        </div>
        <a id='go_to_history_anchor' href='/bingo/history.php'>Check out the previous games!</a>
    </body>
</html>