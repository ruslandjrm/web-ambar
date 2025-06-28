<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();


$content = get_field('page_404', 'options') ? get_field('page_404', 'options') : '';



if($content){
//content
$heading_block = $content['heading_block'] ? $content['heading_block'] : '';
$ht = $heading_block['heading_size'] ? $heading_block['heading_size'] : 'h2';
$eyebrow = $heading_block['eyebrow'] ? '<span class="eyebrow">'.$heading_block['eyebrow'].'</span>' : '';
$heading = $heading_block['heading'] ? '<'.$ht.'>'.$heading_block['heading'].'</'.$ht.'>' : '';

$content_section = $content['content_text'] ? $content['content_text'] : '';

$image_hero = $content['image_hero'] ? $content['image_hero'] : '';
$keywords = $content['keywords'] ? $content['keywords'] : '';

$buttons_block = $content['buttons_block'] ? $content['buttons_block'] : '';
$buttons_justification = $buttons_block['buttons_justification'];
$buttons = $buttons_block['buttons'];

$background_settings = $content['background_settings'] ? $content['background_settings'] : '';
$styles_settings = $content['styles_settings'] ? $content['styles_settings'] : '';

//Styles Settings
$styles = styles_global_settings($styles_settings);

//Background Settings
$background = bg_global_settings($background_settings);

?>

<section class="general-section page-404 <?php echo $background['parallax'].' '.$styles['custom_class'].' size-'.$styles['content_width'].'  heading-'.$styles['heading_color'].' text-'.$styles['text_color']; ?>" style="background:<?php echo $background['bg'];?> no-repeat; text-align: <?php echo $styles['text_align'];?>!important; margin-top: <?php echo $styles['margin_top']; ?>px; margin-bottom:  <?php echo $styles['margin_bottom']; ?>px; padding: <?php echo $styles['padding_top']; ?>px 0 <?php echo $styles['padding_bottom']; ?>px;" id="<?php echo $id; ?>">
    <?php echo $background['video_content']; ?>
    <?php echo $background['overContent']; ?>
    <div class="container" id="<?php echo $styles['section_anchor']; ?>" data-aos-duration="800" data-aos="fade-up">
        
        <div class="row">
            <div class="col-12 col-lg-7 content-left">
                <?php echo $eyebrow; ?>
                <?php echo $heading; ?>
                <?php echo $content_section; ?>
                <?php block_buttons($buttons,$buttons_justification); ?>
            </div>

            <div class="col-12 col-lg-5 content-right">

                <?php if($image_hero){ ?>
                    <img src=" <?php echo $image_hero['url']; ?>" alt=" <?php echo $image_hero['alt']; ?>">
                <?php }  ?>

                <?php if($keywords){ ?>
                    <div class="text-scroller">
                        <div class="text-content" id="textContent">
                            <?php foreach($keywords as $item){
                                $keyword = $item['keyword'] ? $item['keyword'] : '' ;
                                if($keyword){ ?>
                                    <p class="typewriter-text"><?php echo $keyword; ?></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <script>
       
        document.addEventListener('DOMContentLoaded', function () {
            const texts = document.querySelectorAll('.typewriter-text');
            let currentIndex = 0;

            function typeText(textElement, text, i, callback) {
                textElement.style.color = '#ffff';
                if (i < text.length) {
                    textElement.textContent += text.charAt(i);
                    setTimeout(() => typeText(textElement, text, i + 1, callback), 130); 
                } else {
                    setTimeout(() => deleteText(textElement, text, text.length - 1, callback), 2500); 
                }
            }

            function deleteText(textElement, text, i, callback) {
                if (i >= 0) {
                    textElement.textContent = text.substring(0, i);
                    setTimeout(() => deleteText(textElement, text, i - 1, callback), 100); // Erasing speed
                } else {
                    textElement.style.color = '#ffff';
                    textElement.style.display = 'none';
                    if (callback) callback();
                }
            }

            function showNextText() {
                if (currentIndex < texts.length) {
                    const currentTextElement = texts[currentIndex];
                    const currentText = currentTextElement.getAttribute('data-text') || currentTextElement.textContent;
                    currentTextElement.setAttribute('data-text', currentText);
                    currentTextElement.style.display = 'inline-block';
                    currentTextElement.textContent = '';
                    typeText(currentTextElement, currentText, 0, () => {
                        currentIndex++;
                        showNextText();
                    });
                } else {
                    currentIndex = 0;
                    setTimeout(showNextText, 500); // Pause before restarting the infinite loop
                }
            }

            showNextText();
        });
    </script>

</section>

<?php } 
get_footer();
?>