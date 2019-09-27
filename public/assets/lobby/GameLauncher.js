(function(){
    const GameLauncher = {
        gamesContainer: $('#games-container'),

        initEventHandlers: function() {
            this.gamesContainer.on('click', '.game-launcher', this.launchGame.bind(this));
        },
        launchGame: function(event) {
            const launchCode = $(event.currentTarget).data('launchcode');
            alert(launchCode);
        },

    }
    GameLauncher.initEventHandlers();
})();