<?php
/**
 * FAQ accordion item. Native <details>/<summary> for keyboard + screen-reader
 * support out of the box; JS enhances the open/close animation only.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;
?>
<details class="faq-item">
	<summary class="faq-item__question">
		<span><?php the_title(); ?></span>
		<span class="faq-item__icon" aria-hidden="true"></span>
	</summary>
	<div class="faq-item__answer"><?php the_content(); ?></div>
</details>
