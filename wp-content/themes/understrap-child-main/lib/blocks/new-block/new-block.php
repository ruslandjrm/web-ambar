<?php
/*
 * General Content Block
 */
$content = get_field('general_block');
if (!$content) return;

// Block ID
$id = isset($block['id']) ? esc_attr($block['id']) : '';
$align_class = !empty($block['align']) ? 'align' . esc_attr($block['align']) : '';

// Heading Block
$heading_block = isset($content['heading_block']) ? $content['heading_block'] : [];
$ht = !empty($heading_block['heading_size']) ? esc_html($heading_block['heading_size']) : 'h2';
$eyebrow = !empty($heading_block['eyebrow']) ? '<span class="eyebrow">' . esc_html($heading_block['eyebrow']) . '</span>' : '';
$heading = !empty($heading_block['heading']) ? "<{$ht}>" . esc_html($heading_block['heading']) . "</{$ht}>" : '';

// Content Section
$content_section = !empty($content['content_text']) ? wp_kses_post($content['content_text']) : '';

// Buttons
$buttons_block = isset($content['buttons_block']) ? $content['buttons_block'] : [];
$buttons_justification = isset($buttons_block['buttons_justification']) ? esc_attr($buttons_block['buttons_justification']) : '';
$buttons = isset($buttons_block['buttons']) ? $buttons_block['buttons'] : [];

// Background and Styles Settings
$background_settings = isset($content['background_settings']) ? $content['background_settings'] : [];
$styles_settings = isset($content['styles_settings']) ? $content['styles_settings'] : [];
$styles = styles_global_settings($styles_settings);
$background = bg_global_settings($background_settings);

// Classes and Inline Styles
$section_classes = trim("general-section block-content $align_class {$background['parallax']} {$styles['custom_class']} size-{$styles['content_width']} heading-{$styles['heading_color']} text-{$styles['text_color']}");

$inline_styles = trim("background:{$background['bg']} no-repeat; text-align: {$styles['text_align']} !important; margin-top: {$styles['margin_top']}px; margin-bottom: {$styles['margin_bottom']}px; padding: {$styles['padding_top']}px 0 {$styles['padding_bottom']}px;");
?>

<section class="<?php echo esc_attr($section_classes); ?>" style="<?php echo esc_attr($inline_styles); ?>" id="<?php echo $id; ?>">
    <?php echo $background['video_content']; ?>
    <?php echo $background['overContent']; ?>
    <div class="container" id="<?php echo esc_attr($styles['section_anchor']); ?>" data-aos-duration="800" data-aos="fade-up">
        <?php echo $eyebrow; ?>
        <?php echo $heading; ?>
        <?php echo $content_section; ?>
        <?php block_buttons($buttons, $buttons_justification); ?>
    </div>
</section>
