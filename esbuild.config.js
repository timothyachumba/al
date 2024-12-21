const esbuild = require('esbuild');
const fs = require('fs');
const path = require('path');

const srcDir = path.join(__dirname, 'src', 'js');
const outDir = path.join(__dirname, 'public', 'dist', 'assets');

fs.readdirSync(srcDir).forEach(file => {
  if (path.extname(file) === '.js') {
    esbuild.build({
      entryPoints: [path.join(srcDir, file)],
      bundle: true, // Set to false if you don't want to bundle dependencies
      minify: true,
      sourcemap: true, // Set to false in production
      outfile: path.join(outDir, file),
    }).catch(() => process.exit(1));
  }
});