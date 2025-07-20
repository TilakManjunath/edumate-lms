<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <h1><a href="<?php echo home_url(); ?>">EduMate</a></h1>
    <nav>
        <?php wp_nav_menu(['theme_location' => 'main-menu']); ?>
    </nav>
</header>
<main>
