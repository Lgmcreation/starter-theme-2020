const { src, dest, series, parallel, watch, lastRun } = require('gulp')
//CSS
const sass = require('gulp-sass')
const postcss = require('gulp-postcss')
const cssnano = require('gulp-cssnano')
const mqpaker = require('css-mqpacker')
const autoprefixer = require('autoprefixer')
//JS Browserify + Watchify
const browserify = require('browserify')
const watchify = require('watchify')
const buffer = require('vinyl-buffer')
const source = require('vinyl-source-stream')
const babelify = require('babelify')
const uglify = require('gulp-uglify')
const assign = require('lodash.assign')

//IMG
const imagemin = require('gulp-imagemin')
//SVG
const svgstore = require('gulp-svgstore')
const svgmin = require('gulp-svgmin')
//UTIL
const newer = require('gulp-newer')
const del = require('del')
const noop = require('gulp-noop')
const plumber = require('gulp-plumber')
const notify = require('gulp-notify')
const rename = require('gulp-rename')
const util = require('gulp-util')
const _ = require('lodash');
//SERVE
const browserSync = require('browser-sync')
const server = browserSync.create();

// CONST
const prodBuild = (process.env.NODE_ENV === 'production')
const dir = {
    dev: 'dev/',
    build: 'assets/'
}

const plumberErrorHandler = {
    errorHandler: notify.onError({
        title: 'Gulp',
        message: 'Error: <%= error.message %>'
    })
}

const jsConfig = {
    app: dir.dev + 'js/app.js',
    watch: dir.dev + 'js/**/*.js',
    build: dir.build + 'js',
}

const cssConfig = {
    watch: dir.dev + 'css/*.scss',
    build: dir.build + 'css',
}

const imageConfig = {
    watch: dir.dev + 'images/*.{jpg,jpeg,png,svg}',
    build: dir.build + 'images',
    Opts: {
        optimizationLevel: 5,
        progressive: true
    }
}

const svgConfig = {
    watch: dir.dev + 'images/svg/*.svg',
    build: dir.build + 'images'
}

// Clean assets
function clean() {
    return del([dir.build])
}


//JS Browserify
function jsBrowserify() {
    var bro;
    var browserifyOpts = {
        entries: [jsConfig.app],
        debug: prodBuild ? false : true,
        transform: [['babelify', { presets: ["@babel/preset-env"] }]]
    };
    var watchifyOpts = assign({}, watchify.args, browserifyOpts);

    if (prodBuild) {
        bro = browserify(browserifyOpts);
    } else {
        bro = watchify(browserify(watchifyOpts));
        bro.on('update', function () {
            rebundle(bro);
        });
    }

    function rebundle(bundler) {

        return bundler.bundle()
            .on('error', function (e) {
                this.emit('end') // important crashing on error
                return notify().write(e);
            })
            .pipe(source('app.js'))
            .pipe(buffer())
            .pipe(prodBuild ? uglify() : noop())
            .pipe(rename("main.min.js"))
            .pipe(dest(jsConfig.build))
    }

    return rebundle(bro);
}

// CSS
function css() {
    return src(cssConfig.watch, prodBuild ? { sourcemaps: false } : { sourcemaps: true })
        .pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            includePaths: ['node_modules']
        }))
        .pipe(postcss([autoprefixer(), mqpaker()]))
        .pipe(prodBuild ? cssnano({ zindex: false, colormin: false }) : noop())
        .pipe(prodBuild ? (dest(cssConfig.build)) : (dest(cssConfig.build, { sourcemaps: '.' })))
}

// IMAGE
function image() {
    return src(imageConfig.watch)
        .pipe(newer(imageConfig.build))
        .pipe(imagemin(imageConfig.Opts))
        .pipe(dest(imageConfig.build))
}

// SVG
function svg() {
    return src(svgConfig.watch)
        .pipe(svgmin())
        .pipe(svgstore())
        .pipe(rename('svguse.svg'))
        .pipe(dest(svgConfig.build));
}

//SERVER
function reload(done) {
    server.reload();
    done();
}
function serve(done) {
    server.init({
        proxy: 'http://localhost/',
        port: 3000
    });
    done();
}

//WATCHER
function watcher() {
    watch('*.php', reload)
    watch(imageConfig.watch, series(image, reload))
    watch(jsConfig.watch, series(jsBrowserify, reload))
    watch(svgConfig.watch, series(svg, reload))
    watch(cssConfig.watch, series(css, reload))
}

module.exports = {
    default: series(clean, parallel(css, jsBrowserify, image, svg), serve, watcher),
    build: series(clean, parallel(css, jsBrowserify, image, svg)),
}