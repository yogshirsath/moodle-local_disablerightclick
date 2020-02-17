// Gulp.
var gulp = require('gulp');

// Sass/CSS stuff.
var exec  = require('gulp-exec');
var notify = require("gulp-notify");
var babel = require('gulp-babel');

// JS stuff.
var minify = require('gulp-minify');

gulp.task('compress', function(done) {
    gulp.src(['./amd/src/*.js'])
    .pipe(minify({
        ext:{
            min: '.js'
        },
        noSource: true,
        ignoreFiles: []
    }))
    .pipe(gulp.dest('./amd/build'));
    done();
});

gulp.task('purge', gulp.series(function() {
    return gulp.src('.')
    .pipe(exec('php ./../../admin/cli/purge_caches.php'))
    .pipe(notify('Purged All'))
}));

gulp.task('watch', function(done) {
    gulp.watch('./amd/src/*.js', gulp.series('compress', 'purge'));
    gulp.watch(['./lang/**/*.php', './templates/**/*.mustache'], gulp.series('purge'));
});

gulp.task('default', gulp.series('compress', 'purge', 'watch'));
