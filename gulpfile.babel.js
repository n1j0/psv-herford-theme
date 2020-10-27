import autoprefixer from 'autoprefixer'
import browsersync from 'browser-sync'
import del from 'del'
import { dest, parallel, series, src, watch } from 'gulp'
import cleancss from 'gulp-clean-css'
import cmq from 'gulp-group-css-media-queries'
import gulpif from 'gulp-if'
import imagemin from 'gulp-imagemin'
import postcss from 'gulp-postcss'
import sass from 'gulp-sass'
import sourcemaps from 'gulp-sourcemaps'
import pot from 'gulp-wp-pot'
import named from 'vinyl-named'
import yargs from 'yargs'
import webpack from 'webpack-stream'

const PROD = yargs.argv.prod

const server = browsersync.create()

export const serve = done => {
  server.init({
    proxy: 'https://psv.badminton.test'
  })
  done()
}

export const styles = () => {
  return src('src/scss/style.scss')
    .pipe(gulpif(!PROD, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PROD, postcss([autoprefixer])))
    .pipe(cmq())
    .pipe(gulpif(PROD, cleancss({ compatibility: 'ie11' })))
    .pipe(gulpif(!PROD, sourcemaps.write()))
    .pipe(dest('../psv-herford-badminton'))
    .pipe(server.stream())
}

export const scripts = () => {
  return src(['src/js/main.js'])
    .pipe(named())
    .pipe(webpack({
      module: {
        rules: [
          {
            test: /\.js$/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env']
              }
            }
          }
        ]
      },
      mode: PROD ? 'production' : 'development',
      devtool: !PROD ? 'inline-source-map' : false,
      output: {
        filename: '[name].js'
      },
    }))
    .pipe(dest('../psv-herford-badminton/js'))
    .pipe(server.stream())
}

export const images = () => {
  return src('src/img/**/*.{jpg,jpeg,png,svg,gif}')
    .pipe(gulpif(PROD, imagemin([
        imagemin.gifsicle({ interlaced: true }),
        imagemin.mozjpeg({ quality: 75, progressive: true }),
        imagemin.optipng({ optimizationLevel: 3 }),
        imagemin.svgo({
          plugins: [
            { removeViewBox: true },
            { cleanupIDs: false }
          ]
        })
      ],
      {
        verbose: true
      }
    )))
    .pipe(dest('../psv-herford-badminton/img'))
    .pipe(server.stream())
}

export const copy = () => {
  return src(['src/**/*', '!src/{img,js,plugins,languages,scss}', '!src/{img,js,plugins,languages,scss}/**/*'])
    .pipe(dest('../psv-herford-badminton'))
    .pipe(server.stream())
}

export const language = () => {
  return src('src/**/*.php')
    .pipe(pot({
        domain: 'psv-herford'
      }
    ))
    .pipe(dest('../psv-herford-badminton/languages/psv-herford.pot'))
}

export const cleanup = () => del(['../psv-herford-badminton/**/*'], { force: true })

export const watchChanges = () => {
  watch(['src/scss/**/*.scss', 'src/scss/style.scss'], styles)
  watch('src/js/**/*.js', scripts)
  watch('src/img/**/*{jpg, jpeg, png, svg, gif}', images)
  watch(['src/**/*', '!src/{img,js,plugins,languages,scss}', '!src/{img,js,plugins,languages,scss}/**/*'], copy)
}

export const dev = series(cleanup, parallel(styles, scripts, images, copy), language, serve, watchChanges)

export const build = series(cleanup, parallel(styles, scripts, images, copy), language)

export default dev
