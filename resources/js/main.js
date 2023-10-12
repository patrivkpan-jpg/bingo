$(document).ready(function() {

    const main = {

        baseUrl : '/bingo/controllers',

        playerName : '',

        startDatetime : '',
    
        bingoCard : [],
    
        pickedBingoPairs : [],

        numberOfTurns : 0,
    
        init : function () {
            this.bindElements();
            this.registerEvents();
            this.generateStartDatetime();
            this.resetBingo();
            this.generateBingoCard();
        },
    
        bindElements : function () {
            this.enterNameBtn = $('#enter_name_btn');
            this.enterNameInput = $('#enter_name_input');
            this.nextTurnBtn = $('#next_turn_btn');
            this.bingoTableBody = $('#bingo_table tbody');
        },
    
        registerEvents : function () {
            this.enterNameBtn.click(function () {
                main.enterPlayerName();
            })
            this.nextTurnBtn.click(function () {
                main.generateBingoPair();
            })
            this.bingoTableBody.on('click', '.bingo-cell-btn', function() {
                main.crossBingoCell($(this));
            });
            
        },

        generateStartDatetime : function () {
            let currentDate = new Date();
            this.startDatetime = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1}-${currentDate.getDate()} ${currentDate.getHours()}:${currentDate.getMinutes()}:${currentDate.getSeconds()}`
        },

        enterPlayerName : function () {
            main.playerName = main.enterNameInput.val();
            main.enterNameInput.prop('disabled', true);
            $(this).prop('disabled', true);
            $('#bingo_card_header').text(`${main.playerName}'s bingo card`);
            $('.bingo-container').css('display', 'grid');
        },
    
        generateBingoCard : function () {
            $.ajax({
                method : 'GET',
                url    : this.baseUrl + '/generateBingoCard.php',
            }).done(function (res) {
                main.bingoCard = JSON.parse(res);
                main.populateBingoTable();
            });
        },
    
        populateBingoTable : function () {
            for (let i = 0; i < 25; i++) {
                if (i % 5 === 0) {
                    $('#bingo_table tbody').append('<tr>')
                }
                let number = this.bingoCard.numbersForDisplay[i];
                let letter = Object.keys(this.bingoCard.card).find(key => this.bingoCard.card[key].includes(number));
                $('#bingo_table tr:last').append(`<td><button class='bingo-cell-btn' data-letter=${letter} data-number=${number}>${number}</button></td>`)
            }
        },

        crossBingoCell : function (element) {
            let bingoCellData = $(element).data();
            console.log(bingoCellData)
            if (this.checkBingoCell(bingoCellData) === true) {
                $(element).prop('disabled', true);
                $(element).addClass('picked');
                this.bingoCard.card[bingoCellData.letter] = this.bingoCard.card[bingoCellData.letter].filter(item => item !== bingoCellData.number);
                this.checkIfWinner();
            } else {
                alert('No cheating!');
            }
        },

        checkBingoCell : function (bingoCellData) {
            return this.pickedBingoPairs.pickedBingoPairs[bingoCellData.letter].includes(bingoCellData.number)
        },

        checkIfWinner : function () {
            let letters = Object.keys(this.bingoCard.card);
            letters.forEach(letter => {
                if (this.bingoCard.card[letter].length === 0) {
                    alert('Contragulations! You won the game!');
                    $('.bingo-cell-btn').prop('disabled', true);
                    this.nextTurnBtn.prop('disabled', true);
                    main.resetBingo()
                    main.logHistory()
                    return;
                }
            });
        },

        logHistory : function () {
            $.ajax({
                method : 'POST',
                url    : this.baseUrl + '/insertBingoGame.php',
                data   : {
                    player        : this.playerName,
                    startDatetime : this.startDatetime,
                    numberOfTurns : this.numberOfTurns
                }
            });
        },

        resetBingo : function () {
            $.ajax({
                method : 'GET',
                url    : this.baseUrl + '/resetBingo.php',
            });
        },
    
        generateBingoPair : function () {
            $.ajax({
                method : 'GET',
                url    : this.baseUrl + '/generateBingoPair.php',
            }).done(function (res) {
                main.pickedBingoPairs = JSON.parse(res);
                $('.bingo-pair-list').prepend(`<h2>${main.pickedBingoPairs.newBingoPair}</h2>`)
                main.numberOfTurns++;
            }).always(function () {
                if (main.pickedBingoPairs.allBingoPairsPicked === true) {
                    alert('All bingo pairs have been picked!')
                }
            });
        }
    
    }
    main.init();
});