module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // vars
        srcDir: 'assets',
        webDir: 'web',
        targetDir: '<%= webDir %>/<%= srcDir %>',

        jshint: {
            files: ['Gruntfile.js', '<%= targetDir %>/js/**/*.js'],
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
                    mainConfigFile: '<%= targetDir %>/js/main.js',
                    appDir: '<%= srcDir %>',
                    baseUrl: './js',
                    dir: '<%= targetDir %>',
                    modules: [
                        {
                            name: "main",
                            include: ['jquery']
                        },
                        {
                            name: 'pages/homepage',
                            exclude: ['main']
                        },
                        {
                            name: 'pages/dashboard',
                            exclude: ['main']
                        }
                    ],
                    optimize: "none",
                    optimizeCss: "none"
                }
            }
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        src: ['<%= srcDir %>/**'],
                        dest: '<%= webDir %>'
                    }
                ]
            }
        },
        clean: {
            build: {
                src: ['<%= targetDir %>/**']
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
                files: ['assets/js/**'],
                tasks: ['clean:build', 'jshint', 'copy'],
                options: {
                    spawn: true
                }

            },
            less: {
                files: 'assets/css/*.less',
                tasks: ['clean:build', 'less', 'copy'],
                options: {
                    spawn: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('test', ['jshint']);
    grunt.registerTask('default', ['jshint']);

    grunt.registerTask('copy:assets', ['clean:build', 'copy']);
};
