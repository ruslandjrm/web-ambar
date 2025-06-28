# Understrap Child Theme

## Recommendations

Before proceeding with development, make sure to follow these important recommendations:

1. **Install dependencies**:
    First, developers should run `npm install` to ensure all dependencies are installed.
  
2. **Compile the SASS**:
    - To compile the general theme SASS and blocks, use the following command:
      ```bash
      npm run watch
      ```

### Coding Best Practices

1. **Blocks Creation**:
    - Check the configuration of the general-content block to see how the other blocks should be created.
    - Just create the scss file for each block, the css file will be created automatically when compiled
    - Once you have created the block files and registered them in /lib/blocks.php, simply add the name of your block to the blocks array in both the register_acf_blocks() and enqueue_block_styles() methods.

2. **Fonts**:
    - Never load third-party fonts in CSS. When using Google Fonts or TypeKit, add links in the head directly, not through the `wp_enqueue_style()` function.

3. **WordPress Coding Standards**:
    - **PHP**: 
      - Do not use PHP shorthand tags `<?= $some_var ?>` or `<? … ?>`.
      - Use dashes for filenames (e.g., `general-template.php`).
    - **CSS**:
      - a) For color, especially for box shadows, use `rgba(0, 0, 0, 0.1)` instead of extended HEX codes (e.g., `#00000019`).
      - b) Always use lowercase for hex codes (e.g., `#041e42` instead of `#041E42`).
      - c) Use backslashes for comments in CSS, as these do not get output when compiling.


Please review these points and let me know your thoughts.
