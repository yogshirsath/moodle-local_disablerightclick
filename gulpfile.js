// Gulp.
var gulp = require('gulp');

// Sass/CSS stuff.
var exec = require('gulp-exec');
var notify = require("gulp-notify");

// JS stuff.
var minify = require('gulp-minify');

gulp.task('compress', function() {
    return gulp.src(['./amd/src/*.js'])
    .pipe(minify({
        ext: {
            min: '.js'
        },
        noSource: true,
        ignoreFiles: []
    }))
    .pipe(gulp.dest('./amd/build'));
});

gulp.task('purgejs', gulp.series(function() {
    return gulp.src('.')
    .pipe(exec('php ./../../admin/cli/purge_caches.php --js=true'))
    .pipe(notify('Purged JS'));
}));

gulp.task('purgelang', gulp.series(function() {
    return gulp.src('.')
    .pipe(exec('php ./../../admin/cli/purge_caches.php --lang=true'))
    .pipe(notify('Purged Lang'));
}));

gulp.task('purge', gulp.series(function() {
    return gulp.src('.')
    .pipe(exec('php ./../../admin/cli/purge_caches.php'))
    .pipe(notify('Purged All'));
}));

gulp.task('watch', function(done) {
    gulp.watch('./amd/src/*.js', gulp.series('compress', 'purgejs'));
    gulp.watch(['./lang/**/*.php',], gulp.series('purgelang'));
    gulp.watch(['./templates/**/*.mustache', './styles.css'], gulp.series('purge'));
    done();
});

gulp.task('default', gulp.series('compress', 'purge', 'watch'));
