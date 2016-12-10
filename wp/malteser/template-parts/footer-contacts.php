<?php
	$address = '&emsp;Україна, Київ, вул.&nbsp;Виборзька&nbsp;89';
	if ( pll_current_language() != 'uk' ){ 
		$address = '&emsp;Ukraina, Kijów, ul.&nbsp;Wyborgska&nbsp;89';
	}
?>
<p><i class="icon-location"></i><?php echo $address; ?></p>
<p><i class="icon-phone"></i>&emsp;<a href="tel:+380502242414">+380&nbsp;50&nbsp;224-24-14</a></p>
<p><i class="icon-mail"></i>&emsp;<a href="mailto:malteser.kyiv@gmail.com">malteser.kyiv@gmail.com</a></p>
