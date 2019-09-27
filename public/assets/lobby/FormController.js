(function(){
    const FormController = {
        gameSearchBtn: $('#game-search-btn'),
        brandSelect: $('#brand-select'),
        countrySelect: $('#country-select'),
        categorySelect: $('#category-select'),

        initEventHandlers: function() {
            this.gameSearchBtn.click(this.triggerSearchDetails.bind(this));
        },

        triggerSearchDetails: function() {
            const searchParameters = {
                selectedBrand: this.brandSelect.children(" option:selected").val(),
                selectedCountry: this.countrySelect.children(" option:selected").val(),
                selectedCategory: this.categorySelect.children(" option:selected").val(),
            };

            $(document).trigger("lobby:search", searchParameters);
        },

    };
    FormController.initEventHandlers();
})();