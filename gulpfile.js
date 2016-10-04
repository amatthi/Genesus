var gulp = require('gulp')
var concat = require('gulp-concat')


gulp.task('default', ['js', 'watch']);

gulp.task('js', function () {
  gulp.src([
  	'resources/js/vendor/angular.min.js',
  	'resources/js/vendor/**/*.js',
  	'resources/js/main.js',
  	'resources/js/**/*.js'
  	])
    .pipe(concat('public/assets/js/app.js'))
    .pipe(gulp.dest('.'))
})

gulp.task('watch', ['js'], function () {
  gulp.watch('resources/js/**/*.js', ['js'])
})
