# Bootstrap for Genesis

## Introduction

Bootstrap for Genesis is a genesis child theme which integrates [Bootstrap](http://getbootstrap.com/). It uses Gulp to handle tasks, configuration and lint files.

The default branch is under development, use [v4](https://github.com/webdevsuperfast/bootstrap-for-genesis/tree/v4) branch to get the last stable release.

## Installation Instructions

1. Upload the Bootstrap for Genesis theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the Bootstrap for Genesis theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Building from Source

1. Install [Git](https://git-scm.com/).
2. Clone the repository to your local machine.
3. Install [Node](https://nodejs.org/en/).
4. Install [Yarn](https://yarnpkg.com).
5. Install [Gulp](https://gulpjs.com/) globally.
6. Run `yarn install` or `npm install` to install dependencies through terminal/CLI program.
7. Run `git submodule init` and `git submodule update` to add [WP Bootstrap Navwalker](https://github.com/twittem/wp-bootstrap-navwalker).
8. Replace site url in line `49` of `gulpfile.js` to your local development URL(e.g. http://bootstrap.test).
9. Run `gulp` through your favorite CLI program.

## Features

1. Bootstrap 4
2. Bootstrap components
	* Comment Form
	* Search Form
	* Jumbotron
	* Navbar
3. Sass
4. Gulp
5. Footer Widgets(modified to add bootstrap column classes based on the number of widget areas)
6. Additional Widget Areas
	* Home Featured(jumbotron)

## Todos

- [ ] Integrate Genesis Theme Setup API
- [ ] Integrate Genesis Configuration API
- [ ] Integrate AMP Support
- [ ] Gutenberg Support
- [x] Remove SmartMenus support or move to separate plugin
- [x] Remove TGM Plugin Activation Support
- [x] Use Git Submodule for WP Bootstrap Navwalker
- [ ] Code cleanup and bug fixes


## Notes

Use [SmartMenus for Bootstrap](https://github.com/webdevsuperfast/ra-smartmenus-bootstrap) for multi-level dropdown support or checkout the [v4](https://github.com/webdevsuperfast/bootstrap-for-genesis/tree/v4) branch.

## Credits

Without these projects, this theme wouldn't be where it is today.

* [Genesis Framework](http://my.studiopress.com/themes/genesis/)
* [Bootstrap](http://getbootstrap.com)
* [Sass](http://sass-lang.com/)
* [Gulp](http://gulpjs.com/)
* [WP Bootstrap Navwalker](https://github.com/twittem/wp-bootstrap-navwalker)
* [Bootstrap Genesis](https://github.com/salcode/bootstrap-genesis)
* [Bones for Genesis 2.0 with Bootstrap integration](https://github.com/jer0dh/bones-for-genesis-2-0-bootstrap)