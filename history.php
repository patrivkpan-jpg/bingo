<?php
    require('controllers/bingo.php');
?>
<!DOCTYPE html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="resources/js/history.js"></script>

    <link rel="stylesheet" href="resources/css/history.css">
</head>
<html>
    <body>
        <h1>Bingo Game History</h1>
        <div class='bingo-history-container'>
            <div>
                <table id='bingo_history_table'>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Started At</th>
                            <th>Ended At</th>
                            <th>Number of Turns</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <a href='/bingo/main.php'>Play a game!</a>
    </body>
</html>