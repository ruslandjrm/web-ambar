<!-- Logo -->
<div class="container-logo">
    <?php
    if ( function_exists( 'the_custom_logo' ) && get_custom_logo() ) {
        the_custom_logo();
    }else{	
    $theme_settings_header= get_field('theme_settings_header','options');
    $logo_header = !empty($theme_settings_header['logo']) ? $theme_settings_header['logo']['url'] : '' ; 
    ?>
     <a href="<?php echo esc_url( home_url()); ?>">
        <figure>
            <img src="<?php echo esc_url( $logo_header ); ?>" alt="Logo Site">
        </figure>
    </a>

    <?php } ?>
</div>
<div class="content-menu-lists">
    <!-- The WordPress Menu goes here -->
    <?php
    wp_nav_menu( array(
        'theme_location'  => 'primary',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'navbarNavDropdown',
        'menu_class'      => 'navbar-nav ms-auto',
        'fallback_cb'     => '',
        'menu_id'         => 'main-menu',
        'depth'           => 2,
        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
    ) );
    ?>
    <div class="header-buttons content-desktop-tablet">
        <?php echo do_shortcode( '[shortcode_buttons_header]' ); ?>
    </div>
    <div class="search-button">
        <a href="#">
            <img src="<?php  echo get_stylesheet_directory_uri() ?>/assets/img/search.svg " alt="icon search">
        </a>
    </div>
</div>