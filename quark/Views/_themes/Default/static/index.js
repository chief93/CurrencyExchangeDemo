var CurrencyExchange = CurrencyExchange || {};

/**
 * @param {string} symbol
 * @param {Function} callback
 */
CurrencyExchange.Rate = function (symbol, callback) {
	// https://stackoverflow.com/a/34433794/2097055
	var cacheExpired = ((new Date()) - CurrencyExchange.Rate.CacheUpdated) > CurrencyExchange.Rate.CacheTTL;

	if (CurrencyExchange.Rate.Cache[symbol] !== undefined && !cacheExpired) {
		callback(CurrencyExchange.Rate.Cache[symbol]);
		return;
	}

	$.ajax({
		url: '/api/exchange/' + symbol,
		method: 'GET',
		dataType: 'json',

		success: function (response) {
			if (response.status != 200) {
				console.log('[warn]', response);
				return;
			}

			CurrencyExchange.Rate.CacheUpdated = new Date();
			CurrencyExchange.Rate.Cache[symbol] = response.symbol.rate;

			callback(CurrencyExchange.Rate.Cache[symbol]);
		}
	});
};

CurrencyExchange.Rate.Cache = {};
CurrencyExchange.Rate.CacheUpdated = new Date();
CurrencyExchange.Rate.CacheTTL = 5000;  // In milliseconds. Default is 5000 (5 seconds).
										// Value of 0 will disable TTL check and will lead to calling the local API
										// every time Rate() method is used.
										//
										// Please note that this WILL NOT lead to calling of the ExchangeRates (EU bank) API,
										// so it is only a client side optimization mechanism

$(document).on('input', '.ce-index-exchange-symbol', function (e) {
	var input = $(this),
		form = $('#ce-index-exchange'),
		symbol_base_value = form.find('input[name="symbol_base_value"]'),
		symbol_base_code = form.find('input[name="symbol_base_code"]'),
		symbol_coerced_value = form.find('input[name="symbol_coerced_value"]'),
		symbol_coerced_code = form.find('input[name="symbol_coerced_code"]');

	CurrencyExchange.Rate(symbol_coerced_code.val(), function (rate) {
		if (input.is(symbol_base_value)) {
			symbol_coerced_value.val(rate == 0 ? 0.0 : (parseFloat(symbol_base_value.val()) * rate).toFixed(2));
		}

		if (input.is(symbol_coerced_value)) {
			symbol_base_value.val(rate == 0 ? 0.0 : (parseFloat(symbol_coerced_value.val()) / rate).toFixed(2));
		}
	});
});