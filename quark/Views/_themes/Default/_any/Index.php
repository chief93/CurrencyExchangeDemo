<?php
/**
 * Created by PhpStorm.
 * User: alex0
 * Date: 23.01.2019
 * Time: 22:55
 *
 * @var QuarkView|IndexView $this
 * @var QuarkDate $last_update
 */
use Quark\QuarkDate;
use Quark\QuarkView;

use ViewModels\IndexView;
?>
<div class="quark-presence-screen" id="ce-index">
	<form class="quark-presence-container ce-container" id="ce-index-exchange">
		<div class="quark-presence-column">
			<h1>Exchange</h1>
			You can get the value of each of the currencies, by typing in corresponding fields<br />
			<br />
			<input class="quark-input ce-index-exchange-symbol" name="symbol_base_value" placeholder="0.00" />&nbsp;<b>EUR</b><br />
			<input type="hidden" name="symbol_base_code" value="EUR" />
			<input class="quark-input ce-index-exchange-symbol" name="symbol_coerced_value" placeholder="0.00" />&nbsp;<b>USD</b><br />
			<input type="hidden" name="symbol_coerced_code" value="USD" />
		</div>
	</form>
	<div class="quark-presence-container ce-container">
		<div class="quark-presence-column">
			Currency rates last updated at <b><?php echo $last_update->Format('d.m.Y H:i:s'); ?> GMT</b>
		</div>
	</div>
</div>