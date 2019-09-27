const FormRequestFactory = {

    gameSearchRequestParams: function(searchParams) {
        let filterParams = [];

        if (searchParams.selectedBrand != 'null') {
            filterParams.push('brand=' + searchParams.selectedBrand);
        }
        if (searchParams.selectedCountry != 'null') {
            filterParams.push('country=' + searchParams.selectedCountry);
        }
        if (searchParams.selectedCategory != 'null') {
            filterParams.push('category=' + searchParams.selectedCategory);
        }

        filterParams = filterParams.join('&');

        return {
            url: '/api/games?' + filterParams,
            method: 'GET',
            dataType: "json"
        }
    }
};