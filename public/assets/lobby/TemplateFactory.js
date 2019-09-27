const TemplateFactory = {
    gameCard: function(game) {
        let imageUrl = encodeURI("https://stage.whgstage.com/scontent/images/games/​" + game.launchcode + ".jpg");
        imageUrl = imageUrl.replace('%E2%80%8B', '');

        return `
        <div class="col-lg-3 col-md-6 mb-4 game-launcher" data-launchcode="${game.launchcode}">
            <div class="card h-100">
            
                <img class="card-img-top" src="${imageUrl}" alt="">
              <div class="card-body">
                <h4 class="card-title">
                    ${game.name}
                </h4>
                <p>rtp, hot, new</p>
              </div>
              <div class="card-footer">
              <button type="button" class="btn btn-success" id="game-search-btn">Play</button>
              </div>
            </div>
        </div>
        `}
};