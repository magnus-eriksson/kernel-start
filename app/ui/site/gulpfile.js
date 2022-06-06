const { watch, series, parallel, src, dest } = require('gulp');
const concat = require('gulp-concat');
const sass = require('gulp-sass');
const livereload = require('gulp-livereload');
sass.compiler = require('node-sass');

const paths = {
    dist: '../../../public/static',
    sass: './scss',
    js: './js',
    nodeModules: './node_modules'
};


/**
 * Concatenate JS files
 */
function js(cb) {
    return src([
            paths.js + '/libs/*.js',
            paths.js + '/main.js',
        ])
        .pipe(concat('main.js'))
        .pipe(dest(paths.dist));}


/**
 * Build sass files
 */
function css() {
    return src([
            paths.sass + '/main.scss'
        ])
        .pipe(concat('main.css'))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(dest(paths.dist))
        .pipe(livereload());
}


/**
 * Export tasks
 */
exports.default = function () {
    // CSS
    livereload.listen();
    watch([
            paths.sass + '/**/*.scss',
        ],
        {
            ignoreInitial: false
        },
        series(css)
    );

    //JS
    watch([
            paths.js + '/*.js',
            paths.js + '/**/*.js'
        ],
        {
            ignoreInitial: false
        },
        series(js)
    );  
};
