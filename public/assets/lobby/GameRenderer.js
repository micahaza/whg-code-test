(function(TemplateFactory){
    const GameRenderer = {
        gamesContainer: $('#games-container'),

        initEventHandlers: function() {
            $(document).on("lobby:games_loaded", this.renderGames.bind(this));
        },
        renderGames: function(event, games) {
            let html = [];

            games.data.forEach(function(game){
                html.push(TemplateFactory.gameCard(game));
            });

            this.gamesContainer.html(html.join(''));
        },

    }
    GameRenderer.initEventHandlers();
})(TemplateFactory);