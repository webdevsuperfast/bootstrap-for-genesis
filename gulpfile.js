var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    del = require('del');

// CSS
gulp.task('styles', function(){
    return gulp.src('assets/scss/style.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('temp/css'))
        .pipe(rename('style.css'))
        .pipe(cssnano())
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete' }));
} );

// JSHint
gulp.task('lint', function(){
    return gulp.src('assets/js/source/*.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
});

// Scripts
gulp.task('source', function() {
    return gulp.src([
        'assets/js/source/*.js'
    ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('vendor', function(){
    return gulp.src([
        'bower_components/modernizr/modernizr.js',
        'bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
        'bower_components/fitvids/jquery.fitvids.js',
        'assets/js/vendor/uilang.js'
    ])
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean
gulp.task('clean', function(cb) {
    del(['temp/css', 'temp/js'], cb)
});

// Default task
gulp.task('default', function() {
    gulp.start('clean', 'styles', 'lint', 'source', 'vendor', 'watch');
});

// Watch
gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], ['styles']);

    // Watch .js files
    gulp.watch(['assets/js/vendor/*.js'], ['vendor']);
    gulp.watch(['assets/js/source/*.js'], ['source']);
});
