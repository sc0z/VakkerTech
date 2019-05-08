# VakkerTech.com WordPress Project

- This is the WordPress v.5.2 project for VakkerTech.com
- This is a re-write of our previous website.
- Designed on Windows 10 using VS Code + XAMPP

## Webpack 4 Asset Management

- WebPack 4 is used in the VakkerTech theme to bundle all frontend theme assets:
  - JavaScript
  - Sass
  - Images
  - Fonts
- The webpack bundle files "chunks" are output to a directory named "dist" inside of the theme directory root
  - JS -> Transpiled using Babel from ES6+ to ES2015, uglified, minified
  - Images -> Not doing much with this yet, but will be used for optimization/compression. WordPress stores its images inside of the Media Library, which requires a WordPress plugin like SmushPro to optimize/compress
  - Sass -> Compiled to CSS and minified
    - Using MiniCssExtractPlugin's loader with webpack so a separate [file].min.css file is built and extracted from the bundle
    - Alternatively, I can use 'style-loader', which will inline all of the minified CSS in a style tag inside of the head element
    - Not sure which is better for performance yet - still testing webpack 4
  - Fonts -> Downloading & Base64 encoding Roboto Condensed using the GoogleFontsPlugin webpack plugin
    - May optimize the build in future by changing this to serve fonts locally

## Composer Package Management

- Using WP

## Yarn Commands (run from VakkerTech theme folder)

- $ yarn build -> runs webpack and generates /dist folder
- $ yarn watch -> same as build but watches files

## Composer Commands (run from WordPress project root folder)

- $ composer update --with-dependencies -> Updates all packages and its dependencies

- $ composer install -> Downloads and installs all the libraries and dependencies outlined in the composer.lock file. If the file does not exist it will look for composer.json and do the same, creating a composer.lock file.

### Links to resources/packages used

- WordPress -> http://wordpress.org
- WebPack 4 -> https://webpack.js.org/
- Yarn Packages -> https://yarnpkg.com/en/
- WPackagist -> https://wpackagist.org/
- Bootstrap 4 -> https://getbootstrap.com/
- FontAwesome 5 -> https://github.com/FortAwesome/Font-Awesome

### Future Iteration Goals

- Use composer to install WordPress core to a /app directory inside project root.
  - Only files in root will be:
    - composer.json
    - composer.lock
    - README.md
    - index.php
    - .htaccess/nginx.conf 
- Use Docker container with /wp-content and php-ini-updates.ini as local volumes (along with MySQL)
- Deploy Docker image to Digital Ocean instead of shared hosting
- VueJS or ReactJS integrated
- Gutenberg Blocks

### Notes

- composer.lock should always be committed to the repository. It has all the information needed to bring the local dependencies to the last committed state. If that file is modified on the repository, you will need to run composer install again after fetching the changes to update your local dependencies to those on that file.
