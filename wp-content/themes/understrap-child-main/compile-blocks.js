const fs = require("fs");
const path = require("path");
const sass = require("sass");

const blocksDir = path.join(__dirname, "lib/blocks");

const compileSass = (scssFile, cssFile) => {
  const result = sass.renderSync({
    file: scssFile,
    outputStyle: "compressed",
  });

  fs.writeFileSync(cssFile, result.css);
  console.log(`✅ compiled: ${cssFile}`);
};

fs.readdirSync(blocksDir).forEach((block) => {
  const blockPath = path.join(blocksDir, block);
  const scssFile = path.join(blockPath, `${block}.scss`);
  const cssFile = path.join(blockPath, `${block}.css`);

  if (fs.existsSync(scssFile)) {
    compileSass(scssFile, cssFile);
  }
});
