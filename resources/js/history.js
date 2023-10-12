$(document).ready(function() {

    const history = {

        baseUrl : '/bingo/controllers',
    
        historyList : [],

        init : function () {
            this.bindElements();
            this.registerEvents();
            this.retrieveHistory();
        },
    
        bindElements : function () {
            this.enterNameBtn = $('#enter_name_btn');
        },
    
        registerEvents : function () {
            this.enterNameBtn.click(function () {
                history.enterPlayerName();
            });
            
        },
    
        retrieveHistory : function () {
            $.ajax({
                method : 'GET',
                url    : this.baseUrl + '/getBingoGames.php',
            }).done(function (res) {
                history.historyList = JSON.parse(res);
                history.populateHistoryTable();
            });
        },
    
        populateHistoryTable : function () {
            this.historyList.forEach(history => {

                $('#bingo_history_table tbody').append(
                `<tr>
                <td>${history.player}</td>
                <td>${history.started_at}</td>
                <td>${history.ended_at}</td>
                <td>${history.number_of_turns}</td>
                </tr>`)
            })
            // for (let i = 0; i < 25; i++) {
            //     if (i % 5 === 0) {
            //         $('#bingo_table tbody').append('<tr>')
            //     }
            //     let number = this.bingoCard.numbersForDisplay[i];
            //     let letter = Object.keys(this.bingoCard.card).find(key => this.bingoCard.card[key].includes(number));
            //     $('#bingo_table tbody tr:last').append(`<td><button class='bingo-cell-btn' data-letter=${letter} data-number=${number}>${number}</button></td>`)
            // }
        }

    }
    history.init();
});