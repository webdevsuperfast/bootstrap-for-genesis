var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-clean-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    vinylpaths = require('vinyl-paths'),
    merge = require('merge-stream'),
    foreach = require('gulp-flatmap'),
    changed = require('gulp-changed'),
    del = require('del');

// CSS
gulp.task('styles', function(){
    var cssStream = gulp.src([
        'node_modules/smartmenus/dist/addons/bootstrap/jquery.smartmenus.bootstrap.css'
    ])
    .pipe(concat('smartmenus.css'));

    var sassStream = gulp.src('assets/scss/style.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(concat('app.scss'))
    
    var mergeStream = merge(sassStream, cssStream)
        .pipe(concat('app.css'))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('temp/css'))
        .pipe(rename('app.css'))
        .pipe(minifycss())
        .pipe(gulp.dest('assets/css'))
        .pipe(notify({ message: 'Styles task complete' }));
    
    return mergeStream;
});

// JSHint
gulp.task('lint', function(){
    return gulp.src('assets/js/source/*.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
});

// Scripts
gulp.task('scripts', function() {
    return gulp.src([
        'assets/js/source/*.js',
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        'node_modules/smartmenus/dist/jquery.smartmenus.js',
        'node_modules/smartmenus/dist/addons/bootstrap/jquery.smartmenus.bootstrap.js'
    ])
    .pipe(changed('js'))
    .pipe(foreach(function(stream, file){
        return stream
            .pipe(uglify())
            .pipe(rename({suffix: '.min'}))
            .pipe(gulp.dest('temp/js'))
    }))
    .pipe(gulp.dest('assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean
gulp.task('clean', function(cb) {
    return gulp.src('temp/*')
    .pipe(vinylpaths(del))
});

// Copy bootstrap fonts to assets folder
gulp.task('copy', function() {
    return gulp.src(['node_modules/bootstrap-sass/assets/fonts/bootstrap/**/*'], {
        base: 'node_modules/bootstrap-sass/assets/fonts'
    })
    .pipe(gulp.dest('assets/fonts'));
});

// Watch
gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], gulp.series('styles'));

    // Watch .js files
    gulp.watch(['assets/js/vendor/*.js', 'assets/js/source/*.js'], gulp.series('scripts'));
});

gulp.task('default', gulp.series('clean', 'copy', ['styles', 'lint', 'scripts'], 'watch', function(){
    done();
}));
