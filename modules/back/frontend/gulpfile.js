var gulp = require('gulp');
var rename = require('gulp-rename');
var concat = require('gulp-concat');

// TODO Переделать билд на webpack

gulp.task('build', ['styles', 'libs']);

gulp.task('build-w', function() {
    gulp.watch('./src/assets/styles.css', ['styles']);
});

gulp.task('styles', function() {
    gulp
        .src([
            './src/assets/styles.css'
        ])
        .pipe(gulp.dest('./dist/assets'));
});

gulp.task('libs', function() {
    gulp
        .src([
            'limitless/assets/**/**'
        ])
        .pipe(gulp.dest('./dist/lts'));

    gulp
        .src([
            'node_modules/tinymce/**/**'
        ])
        .pipe(gulp.dest('./dist/tinymce'));

    gulp
        .src([
            'tinymce-langs/*'
        ])
        .pipe(gulp.dest('./dist/tinymce/langs'));

    gulp
        .src([
            'tinymce-plugins/**/**'
        ])
        .pipe(gulp.dest('./dist/tinymce/plugins'));

    gulp
        .src([
            'node_modules/cropperjs/dist/**'
        ])
        .pipe(gulp.dest('./dist/cropperjs'));

    gulp
        .src([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/jstree/dist/jstree.min.js'
        ])
        .pipe(gulp.dest('./dist/vendor'));

    gulp
        .src([
            'node_modules/select2/dist/**/**'
        ])
        .pipe(gulp.dest('./dist/select2'));
});

gulp.task('front-office', function() {
    gulp
        .src([
            'front-office/**/**'
        ])
        .pipe(gulp.dest('./dist/front-office'));
});
