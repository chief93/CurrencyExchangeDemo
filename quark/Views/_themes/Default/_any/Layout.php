<?php
/**
 * Created by PhpStorm.
 * User: alex0
 * Date: 23.01.2019
 * Time: 22:09
 *
 * @var QuarkView|LayoutView $this
 */
use Quark\QuarkView;

use ViewModels\LayoutView;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->CETitle(); ?></title>

	<?php echo $this->Resources(); ?>
</head>
<body>
	<div class="quark-presence-screen" id="ce-header">
		<div class="quark-presence-container ce-container">
			<div class="quark-presence-column left" id="ce-header-logo">
				Currency Exchange
			</div>
		</div>
	</div>

	<?php echo $this->View(); ?>
</body>
</html>