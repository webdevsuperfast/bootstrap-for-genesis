var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-clean-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    prettify = require('gulp-jsbeautifier'),
    vinylpaths = require('vinyl-paths'),
    cmq = require('gulp-combine-mq'),
    merge = require('merge-stream'),
    foreach = require('gulp-flatmap'),
    changed = require('gulp-changed'),
    runSequence = require('run-sequence'),
    del = require('del');

// CSS
gulp.task('styles', function(){
    var cssStream = gulp.src([
        'node_modules/smartmenus-bootstrap-4/jquery.smartmenus.bootstrap-4.css'
    ])
    .pipe(concat('smartmenus.css'));

    var sassStream = gulp.src('assets/scss/style.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(concat('app.scss'))
    
    var mergeStream = merge(sassStream, cssStream)
        .pipe(concat('app.css'))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(cmq())
        .pipe(gulp.dest('temp/css'))
        .pipe(rename('app.css'))
        .pipe(prettify())
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
        'node_modules/jquery/dist/jquery.slim.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/smartmenus/dist/jquery.smartmenus.js',
        'node_modules/smartmenus-bootstrap-4/jquery.smartmenus.bootstrap-4.js'
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

// Copy bootstrap fonts to assets folder
gulp.task('copy', function() {
    return gulp.src(['node_modules/font-awesome/fonts/**/**'], {
        base: 'node_modules/font-awesome/fonts'
    })
    .pipe(gulp.dest('assets/fonts/fontawesome'));
});

// Clean
gulp.task('clean', function(cb) {
    return gulp.src('temp/*')
    .pipe(vinylpaths(del))
});

// Default task
gulp.task('default', function() {
    runSequence(
        'clean',
        ['copy', 'styles', 'lint', 'scripts'],
        'watch'
    );
});

// Watch
gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], ['styles']);

    // Watch .js files
    gulp.watch(['assets/js/vendor/*.js', 'assets/js/source/*.js'], ['scripts']);
});
