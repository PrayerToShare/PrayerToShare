// Include gulp
var gulp = require('gulp');

var less = require('gulp-less');
var plugins = require('gulp-load-plugins')();
var _ = require('lodash');

var util = require('gulp-util');
var glob = require('glob');
var fs = require('fs');
var exec = require('child_process').exec;

var config = {
    watchers: {},
    concatenate: { css: {}, js: {} },
    stylesDir:  'web/css',
    scriptsDir: 'web/js'
};

config.less = {
    primary: {
        files: {
            "web/css/main.css": "web/css/main.less"
        },
        dest: "web/css"
    }
};

config.registerWatcher = function(task, search, group) {
    group = group || 'default';
    this.watchers[group] = this.watchers[group] || {};
    this.watchers[group][task] = search;
    this.watchers.default = _.union(this.watchers.default, search);

    return this;
};

config.handleError = function handleError(error) {
    console.log(error.toString());
    this.emit('end');
};

config.includeModule = function includeModule(name) {
    try {
        return require(name);
    } catch(e) {
        if (e.code === 'MODULE_NOT_FOUND') {
            return null;
        }
    }
};

function stringEscape(string) {
    return string ? '"' + string + '"' : '';
}

config.customNotifier = function(options, cb) {
    var filename;

    if (fileName = glob.sync(options.message).pop()) {
        var size = (fs.statSync(fileName)['size'] / 1000.0).toFixed(2) + ' Kb';
        util.log(util.colors.cyan(options.message), util.colors.magenta(size));
    }

    exec(['notify-send', stringEscape(options.title), stringEscape(options.message), options.icon].join(' '));
    cb();
};

config.notification = function notification(status, pluginName, override) {
    var propertyName = pluginName.toLowerCase();
    var passMessage = config[propertyName].passMessage ? config[propertyName].passMessage : '';
    var failMessage = config[propertyName].failMessage ? config[propertyName].failMessage : '';
    var options = {
        title:   ( status == 'pass' ) ? pluginName + ' Passed' : pluginName + ' Failed',
        message: ( status == 'pass' ) ? passMessage : failMessage,
        icon: '-i ' + process.cwd() + '/node_modules/gulp-phpunit/assets/test-' + status + '.png',
        notifier: config.customNotifier
    };

    return _.merge(options, override);
};

module.exports = config;

var lessFiles = _(config.less).pluck('files').map(_.values).flatten().value();

function lessTask(key, task) {
    var src = _.isObject(task) ? _.values(task.files) : task;

    // Task
    gulp.task(key, function() {
        return gulp.src(src)
            // Do not enable for now
            //.pipe(plugins.changed(task.dest, { extension: '.css'}))
            .pipe(plugins.less({ paths: [config.stylesDir] }))
            .on('error', config.handleError)
            .pipe(plugins.rename({ extname: '.less' }))
            .pipe(gulp.dest(findDestPath))
        ;
    });

    // Task Watcher
    lessTaskWatcher(task);
}

function lessTaskWatcher(task) {
    gulp.task('watch:' + task, function() {
        gulp.watch('web/css/**/*.less', [task]);
    });
}

function findDestPath(file) {
    var filesMap = _.invert(_(config.less).pluck('files').reduce(_.merge));
    file.path = process.cwd() + '/' + filesMap[file.path.replace(process.cwd() + '/', '')];

    return file.base;
}

for (var task in config.less) {
    var key = 'less:' + task;

    if (!config.less.hasOwnProperty(task)) {
        return
    }

    // Register task and watcher
    config.registerWatcher(key, _.values(config.less[task].files), 'less');
    lessTask(key, config.less[task]);
}

lessFiles.forEach(function(task) {
    lessTask(task, task);
});

// Compile Our Less
gulp.task('less', _.keys(config.watchers.less));

// Watch Files For Changes
gulp.task('watch:less', function() {
    gulp.watch('./web/css/**/*.less', function(event) {
        gulp.start('less');
    });
});

// Default Task
gulp.task('watch:less', function() {
    gulp.watch('web/css/**/*.less', function(event) {
        var eventRelativePath = event.path.replace(process.cwd() + '/', '');

        if (lessFiles.indexOf(eventRelativePath) >= 0) {
            gulp.start(eventRelativePath);
        } else {
            gulp.start('less');
        }
    });
});
