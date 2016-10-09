var gulp = require('gulp')
var concat = require('gulp-concat')
var uglify = require('gulp-uglify')
var gp_rename = require('gulp-rename')
var sass = require('gulp-sass')


gulp.task('default', ['js', 'css', 'watch']);

gulp.task('js', function() {
    gulp.src([
            'resources/js/vendor/angular.min.js',
            'resources/js/vendor/**/*.js',
            'resources/js/main.js',
            'resources/js/**/*.js'
        ])
        .pipe(concat('public/assets/js/app.js'))
        .pipe(gulp.dest('.'))
        //.pipe(gp_rename('public/assets/js/app.min.js'))
        //.pipe(uglify({ mangle: false }))
        //.pipe(gulp.dest('.'));
})

gulp.task('watch', ['js','css'], function() {
    gulp.watch('resources/js/**/*.js', ['js'])
    gulp.watch('resources/assets/**/*.sass', ['css'])
})

gulp.task('css', function() {
    gulp.src('resources/assets/sass/*.{scss,sass}')
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('public/assets/css/dev.css'))
        .pipe(gulp.dest('.'));
});
