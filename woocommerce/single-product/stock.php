<?php
/**
 * Single Product stock => moved to cart tpl
 */
?>
<span class="stock <?php echo esc_attr( $class ); ?>"><?php echo wp_kses_post( $availability ); ?></span>