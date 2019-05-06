# VakkerTech.com WordPress Project

This is the WordPress v.5.1.1 project for VakkerTech.com
This is a re-write of our previous website.
Designed on Windows 10 using VS Code + XAMPP

# Setup

- Using Composer + WPackagist to manage all plugins
- Using WebPack 4 to manage and bundle all theme assets (fonts, images, css/sass, javascript)
- Sass for stylesheets
- Yarn for package management
- Bootstrap 4 + FontAwesome 5 (free) + Popper.js

## Yarn Commands

- $ yarn build -> runs webpack and generates /dist folder
- $ yarn watch -> same as build but watches files

## Future Iteration

Use Docker container with /wp-content and php-ini-updates.ini as local volumes (along with MySQL)
Deploy Docker image to Digital Ocean instead of shared hosting
ReactJS integrated
Gutenburg Blocks