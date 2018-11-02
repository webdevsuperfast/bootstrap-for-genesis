'use strict';

var gulp = require('gulp'),
    pkg = require('./package.json'),
    toolkit = require('gulp-wp-toolkit');

toolkit.extendConfig({
    theme: {
        name: pkg.theme.name,
		themeuri: pkg.homepage,
		description: pkg.theme.description,
		author: pkg.author,
		authoruri: pkg.theme.authoruri,
		version: pkg.version,
		license: pkg.license,
		licenseuri: pkg.theme.licenseuri,
		tags: pkg.theme.tags,
		textdomain: pkg.name,
		domainpath: pkg.theme.domainpath,
		template: 'genesis',
    },
    css: {
        basefontsize: 16, // Used by postcss-pxtorem.
		cssnano: {
			discardComments: {
				removeAll: true
			},
			zindex: false,
		},
        remreplace: false, // Used by postcss-pxtorem.
        remmediaquery: false, // Used by postcss-pxtorem.
		scss: {
            'smartmenus-bootstrap': {
                src: 'node_modules/smartmenus-bootstrap-4/jquery.smartmenus.bootstrap-4.css',
                dest: 'assets/css/',
                outputStyle: 'compressed',
                sourceMap: true
            }
		},
    },
    js: {
        'app': [
            'develop/js/source/*.js'
        ],
        'jquery': [
            'node_modules/jquery/dist/jquery.js'
        ],
        'popper': [
            'node_modules/popper.js/dist/umd/popper.js'
        ],
        'bootstrap': [
            'node_modules/bootstrap/dist/js/bootstrap.js'
        ],
        'smartmenus': [
            'node_modules/smartmenus/dist/jquery.smartmenus.js'
        ],
        'smartmenus-bootstrap': [
            'node_modules/smartmenus-bootstrap-4/jquery.smartmenus.bootstrap-4.js'
        ]
    },
    dest: {
        js: 'assets/js/',
        css: 'assets/css/'
    },
    server: {
        proxy: 'wordpress.test',
        online: true
    }
});

toolkit.extendTasks(gulp, /* Gulp task overrides. */);