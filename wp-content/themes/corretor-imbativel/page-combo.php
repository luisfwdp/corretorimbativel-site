<?php
/** Template Name: Combo Completo */
defined( 'ABSPATH' ) || exit;
get_header();
get_template_part( 'template-parts/product-landing', null, array( 'product' => 'combo' ) );
get_footer();
