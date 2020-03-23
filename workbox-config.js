module.exports = {
  // Path to be offline cache
  'globDirectory': 'public/',
  'globPatterns': [
      '/**/*.{css,ico,ttf,woff,svg,png,jpg,php,js,xml,webmanifest,json,txt,gif,md,html,scss,eot,woff2,swf,otf}',
      'index.php',
      'mix-manifest.json',
  ],
  'swDest': 'public/service-worker.js',
  'globIgnores': [],
  'swSrc': 'resources/js/themes/sw.js'
};