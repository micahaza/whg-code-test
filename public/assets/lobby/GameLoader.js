(function(FormRequestFactory){
    const GameLoader = {

        initEventListeners: function() {
            $(document).on("lobby:search", this.loadGames.bind(this));
        },
        loadGames: function(event, data) {
            $.ajax(FormRequestFactory.gameSearchRequestParams(data))
            .done(this.onLoadGames.bind(this))
            .fail(this.handleAjaxErrors.bind(this));
        },
        onLoadGames: function(response) {
            if (response.data.length == 0) {
                this.handleGamesNotFound();
                return;
            }
            $(document).trigger("lobby:games_loaded", response);
        },
        handleGamesNotFound: function() {
            // TODO
        },
        handleAjaxErrors: function() {
            // TODO
        },
    };

    GameLoader.initEventListeners();
})(FormRequestFactory);