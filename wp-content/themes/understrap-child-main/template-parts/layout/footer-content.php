<?php

$theme_settings_footer = get_field( 'theme_settings_footer', 'options' ) ? get_field( 'theme_settings_footer', 'options' ) : '';
if ( $theme_settings_footer ) {
	$footer_logo      = $theme_settings_footer['footer_logo'] ? $theme_settings_footer['footer_logo'] : '';
	$headquarters     = $theme_settings_footer['headquarters'] ? '<p>' . $theme_settings_footer['headquarters'] . '</p>' : '';
	$contacts         = $theme_settings_footer['contacts'] ? $theme_settings_footer['contacts'] : '';
	$social_media     = $theme_settings_footer['social_media'] ? $theme_settings_footer['social_media'] : '';
	$additional_links = $theme_settings_footer['additional_links'] ? $theme_settings_footer['additional_links'] : '';
	$subscribe_form   = $theme_settings_footer['subscribe_form'] ? $theme_settings_footer['subscribe_form'] : '';
	$copyright_group  = $theme_settings_footer['copyright_group'] ? $theme_settings_footer['copyright_group'] : '';
	?>
<div class="container">
    <div class="row mb-ls justify-content-between">
        <div class="col-12 col-lg-7">
            <div class="content-footer-logo">
                <?php if ( $footer_logo ) { ?>
                    <a href="/">
                        <img src="<?php echo $footer_logo['url']; ?>" alt="Go to home page">
                    </a>
                <?php } ?>
                <?php echo $headquarters; ?>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <?php if ( $social_media ) { ?>
                <div class="content-social">
                    <?php foreach ( $social_media as $item ) {
                        $icon_social = $item['icon_social'] ? $item['icon_social'] : '';
                        $url_social  = $item['url_social'] ? $item['url_social'] : ''; ?>
                        <a href="<?php echo esc_url( $url_social ); ?>" target="_blank">
                            <i class="fa-brands <?php echo $icon_social; ?>"></i>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row content-info-menus justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <?php if ( $contacts ) { ?>
                <div class="footer-contacts">
                    <?php foreach ( $contacts as $item ) {
                        $title = $item['title'] ? '<h5>' . $item['title'] . '</h5>' : '';
                        $phone = $item['phone'] ? '<a href="' . $item['phone']['url'] . '">' . $item['phone']['title'] . '</a>' : '';
                        $email = $item['email'] ? '<a href="' . $item['email']['url'] . '">' . $item['email']['title'] . '</a>' : '';
                        $link  = $item['link'] ? '<a href="' . $item['link']['url'] . '">' . $item['link']['title'] . '</a>' : ''; ?>
                        <div class="footer-contacts--item">
                            <?php echo $title; ?>
                            <?php echo $phone; ?>
                            <?php echo $email; ?>
                            <?php echo $link; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="row footer-contacts-menus">
                <div class="col-6">
                    <div class="footer-menu">
                        <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'footerMenu1',
                            'container_class' => '',
                        ) );
                        ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="footer-menu">
                        <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'footerMenu2',
                            'container_class' => '',
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <div class="footer-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'footerMenu3',
                    'container_class' => '',
                ) );
                ?>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <div class="footer-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'footerMenu4',
                    'container_class' => '',
                ) );
                ?>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <?php if ( $additional_links ) { ?>
                <div class="aditional-links">
                    <?php
                    foreach ( $additional_links as $item ) {
                        $link = $item['link'] ? $item['link'] : '';
                        if ( $link ) {
                            ?>
                            <a class="btn-site icon-right btn-link btn-color-secondary" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
                                <?php echo $link['title']; ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-button-link.svg" alt="" aria-hidden="true">
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if ( $subscribe_form ) { ?>
                <div class="subscribe-form">
                    <?php
                    $heading = $subscribe_form['heading'] ? '<h5>' . $subscribe_form['heading'] . '</h5>' : '';
                    $content = $subscribe_form['content'] ? '<p>' . $subscribe_form['content'] . '</p>' : '';
                    $form    = $subscribe_form['form'] ? $subscribe_form['form'] : '';
                    ?>
                    <?php echo $heading; ?>
                    <?php echo $content; ?>
                    <?php if ( $form ) { ?>
                        <?php echo do_shortcode( '[gravityform id="' . $form . '" title="false" description="false" ajax="true"]' ); ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    if ( $copyright_group ) {
        $starting_year = ! empty( $copyright_group['starting_year'] ) ? $copyright_group['starting_year'] : '';
        $copyright     = ! empty( $copyright_group['copyright'] ) ? $copyright_group['copyright'] : '';
        $links         = $copyright_group['links'] ? $copyright_group['links'] : null;
        ?>
        <div class="content-copyright">
            <p>&copy; <?php echo do_shortcode( '[copyright_year starting_year="' . $starting_year . '"]' ) . ' ' . $copyright; ?></p>
            <?php if ( $links ) { ?>
                <div class="content-links-copy">
                    <?php
                    foreach ( $links as $item ) {
                        $link = ! empty( $item['link'] ) ? $item['link'] : null;
                        if ( $link && ! empty( $link['url'] ) ) {
                            ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>">
                                <?php echo $link['title']; ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<?php } ?>