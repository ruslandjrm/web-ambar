// Add your custom JS here.
jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 50) {
        jQuery('header.header-site').addClass('scrolled');
    } else {
        jQuery('header.header-site').removeClass('scrolled');
    }
});

jQuery(document).ready(function($) {

    
});

jQuery(document).ready(function($) {
    $('[tabindex="0"]').keydown(function(event) {
      if (event.key === 'Enter' || event.key === ' ') {
        $(this).click();
      }
    });
  });


/*skip content*/
document.addEventListener('DOMContentLoaded', function() {
    const LinkGoSecondSection = document.getElementById('GoSecondSection');
    LinkGoSecondSection.addEventListener('click', function(event) {
        event.preventDefault();
        const secondSection = document.querySelector('.general-section:nth-of-type(2)');
        if (secondSection) {
            secondSection.scrollIntoView({ behavior: 'smooth' });
        } else {
            console.error('the second section was not found.');
        }
    });
});



function autosize() {
    var el = this;
    setTimeout(function() {
        el.style.cssText = 'height:auto; padding:0';
        // for box-sizing other than "content-box" use:
        // el.style.cssText = '-moz-box-sizing:content-box';
        el.style.cssText = 'height:' + (el.scrollHeight + 2) + 'px';
    }, 0);
}

document.fonts.ready.then(function() {
    document.body.classList.add('font-loaded');
  });