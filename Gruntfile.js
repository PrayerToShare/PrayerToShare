module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: ['src/**/*.js'],
                dest: 'dist/<%= pkg.name %>.js'
            }
        },
        uglify: {
            options: {
            banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
            },
            dist: {
                files: {
                'dist/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
                }
            }
        },
        jshint: {
            files: ['Gruntfile.js', 'web/js/{}*.js'],
            options: {
                // options here to override JSHint defaults
                globals: {
                    jQuery: true,
                    console: true,
                    module: true,
                    document: true
                }
            }
        },
        requirejs: {
            compile: {
                options: {
                    mainConfigFile: 'web/js/main.js',
                    appDir: "web",
                    baseUrl: "js",
                    dir: "web/compiled",
                    modules: [
                        {
                            name: "main",
                            include: ['jquery']
                        },
                        {
                            name: 'pages/homepage',
                            exclude: ['main']
                        }
                    ]
                }
            }
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        src: ['assets/**'],
                        dest: 'web'
                    }
                ]
            }
        },
        less: {
            development: {
                options: {
                    paths: ["assets/css"]
                },
                files: {
                    "assets/css/p2s.css": "assets/css/main.less"
                }
            }
        },
        watch: {
            scripts: {
                files: ['assets/vendor/**'],
                tasks: ['copy', 'jshint']
            },
            less: {
                files: 'assets/css/*.less',
                tasks: ['less', 'copy'],
                options: {
                    spawn: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('test', ['jshint']);
    grunt.registerTask('default', ['jshint']);
};
