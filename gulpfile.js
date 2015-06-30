var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require("gulp-rename");
var uglify = require('gulp-uglify');
var minifycss = require('gulp-minify-css');



// Default task
gulp.task('default', ['compile-frontend', 'compile-dashboard']);



// Frontend style
gulp.task('watch-frontend', function() {
    gulp.watch(['resources/assets/sass/*', 'resources/assets/sass/*/*.scss'], ['compile-frontend']);
});

gulp.task('compile-frontend', function() {
    gulp.src('resources/assets/sass/bootstrap.scss')
        .pipe(sass())
        .pipe(minifycss())
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('public/assets/style'));
});



// Dashboard style
gulp.task('watch-dashboard', function() {
    gulp.watch(['resources/assets/sass-dashboard/*', 'resources/assets/sass-dashboard/*/*.scss'], ['compile-dashboard']);
});

gulp.task('compile-dashboard', function() {
    gulp.src('resources/assets/sass-dashboard/bootstrap.scss')
        .pipe(sass())
        .pipe(minifycss())
        .pipe(rename('style-dashboard.min.css'))
        .pipe(gulp.dest('public/assets/style'));
});

