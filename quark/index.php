<?php
/**
 * Created by PhpStorm.
 * User: alex0
 * Date: 23.01.2019
 * Time: 21:54
 */
include __DIR__ . '/loader.php';

const CE_DATA = 'data';

const CE_EXCHANGE_RATES = 'exchange_rates';

use Quark\Quark;
use Quark\QuarkConfig;

use Quark\DataProviders\SQLite;

use Middleware\ExchangeRates\ExchangeRatesConfig;

$config = new QuarkConfig(__DIR__ . '/runtime/application.ini');

$config->Localization(__DIR__ . '/localization.ini');

$config->DataProvider(CE_DATA, new SQLite());

$config->Extension(CE_EXCHANGE_RATES, new ExchangeRatesConfig());

Quark::Run($config);