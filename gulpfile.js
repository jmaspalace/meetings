var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();
var concat = require('gulp-concat');
var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');

gulp.task('desktop-cmarp', function(){
	return gulp.src('assets/scss/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('assets/css'))
		.pipe(cleanCSS())
		.pipe(autoprefixer({
			browsers: ['last 10 versions'],
			cascade: false
		}))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(sourcemaps.write('./', {
			includeContent: false,
			sourceRoot: 'assets/scss/main.scss'
		}))
		.pipe(gulp.dest('themes/css'))
		.pipe(gulp.dest('sites/all/themes/mice/css'))
		.pipe(browserSync.stream({match: '**/*.css'}));
});

gulp.task('desktop-js', function(){
	return gulp.src([
			'assets/js/main.js'
		])
		.pipe(sourcemaps.init())
		.pipe(concat('main.min.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('themes/js'))
		.pipe(gulp.dest('sites/all/themes/mice/js'))
});


gulp.task('default', function(){
	gulp.start('desktop-cmarp', 'desktop-js');
	browserSync.init({
		open: false
	});
	gulp.watch('assets/scss/**/*.scss', ['desktop-cmarp']);
	gulp.watch(['assets/js/*.js', '!dev/assets/js/all.min.js'], ['desktop-js']);
	gulp.watch('assets/js/all.min.js').on('change', browserSync.reload);
	gulp.watch('**/*.php').on('change', browserSync.reload);
});