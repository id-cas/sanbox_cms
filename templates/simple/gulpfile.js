/**
 * Сборщик css и js.
 *
 * $ npm install
 * $ npm install --global gulp-cli
 * $ gulp
 *
 */
const gulp = require('gulp');
const gutil = require('gulp-util');
const plugins = require('gulp-load-plugins')();
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');
const jsmin = require('gulp-minify');
const rimraf = require('gulp-rimraf');


// Исходные файлы
const jsLibraries = [
	'assets/js/lib/**/*.js'
];
const jsCommon = 'assets/js/*.js';
const less = 'assets/less/*.less';
const cssLibraries = 'assets/css/lib/*.css';

// Файлы для минификации
const buildCss = '../../public/css/*.css';
const buildJs = '../../public/js/*.js';
const rimrafCss = '../../public/css/*.min.css';
const rimrafJs = '../../public/js/*-min.js';

const destination = '../../public';

gulp.task('build-js-libraries', function() {
	return gulp.src(jsLibraries)
		.pipe(plugins.concat('site.lib.js'))
		.pipe(gulp.dest(destination + '/js'));
});

gulp.task('build-js-common', function() {
	return gulp.src(jsCommon)
		.pipe(plugins.concat('site.js'))
		.pipe(gulp.dest(destination + '/js'));
});

gulp.task('build-less', function() {
	return gulp.src('assets/less/common.less')
		.pipe(plugins.plumber())
		.pipe(plugins.less())
		.on('error', function(err) {
			gutil.log(err);
			this.emit('end');
		})
		.pipe(plugins.autoprefixer({
			browsers: [
				'> 1%',
				'last 2 versions',
				'firefox >= 4',
				'safari 7',
				'safari 8',
				'IE 8',
				'IE 9',
				'IE 10',
				'IE 11'
			],
			cascade: false
		}))
		.pipe(plugins.concat('site.css'))
		.pipe(gulp.dest(destination + '/css')).on('error', gutil.log);
});

gulp.task('cleancss', function() {
	return gulp.src(rimrafCss, { read: false })
		.pipe(rimraf())
		.on('error', function(err) {
			gutil.log(err);
			this.emit('end');
		});
});

gulp.task('cleanjs', function() {
	return gulp.src(rimrafJs, { read: false })
		.pipe(rimraf())
		.on('error', function(err) {
			gutil.log(err);
			this.emit('end');
		});
});

gulp.task('mincss', function () {
	return gulp.src(buildCss)
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.on('error', function(err) {
			gutil.log(err);
			this.emit('end');
		})
		.pipe(gulp.dest(destination + '/css'));
});

gulp.task('minjs', function() {
	return gulp.src(buildJs)
		.pipe(jsmin())
		.on('error', function(err) {
			gutil.log(err);
			this.emit('end');
		})
		.pipe(gulp.dest(destination + '/js'));
});

gulp.task('build-css-libraries', function() {
	return gulp.src(cssLibraries)
		.pipe(plugins.plumber())
		.on('error', function(err) {
			gutil.log(err);
			this.emit('end');
		})
		.pipe(plugins.concat('site.lib.css'))
		.pipe(gulp.dest(destination + '/css')).on('error', gutil.log);
});

//gulp 4.x
gulp.task('watch', function() {
	gulp.watch(jsLibraries, gulp.series('build-js-libraries'));
	gulp.watch(jsCommon, gulp.series('build-js-common'));
	gulp.watch(less, gulp.series('build-less'));
	gulp.watch(cssLibraries, gulp.series('build-css-libraries'));
});

gulp.task('clean', gulp.series('cleanjs', 'cleancss', function(done) {
	done();
}));

gulp.task('minify', gulp.series('minjs', 'mincss', function(done) {
	done();
}));

gulp.task('compile', gulp.series('cleanjs', 'cleancss', 'minjs', 'mincss', function(done) {
	done();
}));

gulp.task('build', gulp.series('build-js-libraries', 'build-js-common', 'build-less', 'build-css-libraries', 'compile', function(done) {
	done();
}));

gulp.task('default', gulp.series('build-js-libraries', 'build-js-common', 'build-less', 'build-css-libraries', 'compile', function(done) {
	done();
}));

