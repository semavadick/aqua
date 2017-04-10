var gulp = require('gulp');
var typescript = require('gulp-typescript');
var uglify = require('gulp-uglify');
var srcDir = './src';
var distDir = './src';

gulp.task('cart-build', function () {
    gulp.src(srcDir + '/ts/MyCart/Cart.ts')
        .pipe(typescript({
            outFile: 'cart.js'
        }))
        //.pipe(uglify())
        .pipe(gulp.dest(distDir + '/js'))
});

gulp.task('cart', ['cart-build'], function () {
    gulp.watch(srcDir + '/ts/**/*.ts', ['cart-build']);
});