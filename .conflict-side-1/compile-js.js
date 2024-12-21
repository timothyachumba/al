const fs = require('fs');
const path = require('path');
const uglifyJS = require('uglify-js');

const srcDir = path.join(__dirname, 'src', 'js');
const destDir = path.join(__dirname, 'public', 'dist', 'assets');

fs.readdirSync(srcDir).forEach(file => {
  if (path.extname(file) === '.js') {
    const srcFile = path.join(srcDir, file);
    const destFile = path.join(destDir, file);

    const code = fs.readFileSync(srcFile, 'utf8');
    const minified = uglifyJS.minify(code);

    if (minified.error) {
      console.error('Error minifying', file, minified.error);
      return;
    }

    fs.writeFileSync(destFile, minified.code);
  }
});