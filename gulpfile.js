var gulp = require('gulp')
var concat = require('gulp-concat')
var uglify = require('gulp-uglify')
var gp_rename = require('gulp-rename')


gulp.task('default', ['js', 'watch']);

gulp.task('js', function() {
    gulp.src([
            'resources/js/vendor/angular.min.js',
            'resources/js/vendor/**/*.js',
            'resources/js/main.js',
            'resources/js/**/*.js'
        ])
        .pipe(concat('public/assets/js/app.js'))
        .pipe(gulp.dest('.'))
        .pipe(gp_rename('public/assets/js/app.min.js'))
        .pipe(uglify({ mangle: false }))
        .pipe(gulp.dest('.'));
})

gulp.task('watch', ['js'], function() {
    gulp.watch('resources/js/**/*.js', ['js'])
})
