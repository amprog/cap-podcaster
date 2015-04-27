module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            dev: {
                options: {
                    quiet: true,
                    style: 'expanded'
                },
                files: {
                    'cap-podcaster.css':'scss/cap-podcaster.scss',
                }
            },
        },

        // uglify: {
        //     my_target: {
        //         files: {
        //             'js/minified/report-header.min.js': ['bower_components/swiper/dist/js/swiper.jquery.js']
        //         }
        //     }
        // },

        watch: {
            grunt: { files: ['gruntfile.js'] },

            sass: {
                files: 'scss/**/*.scss',
                tasks: ['sass']
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['sass:dev','watch']);
    grunt.registerTask('build', ['sass:dev']);
    // grunt.registerTask('production', ['sass:production','sass:editor']);
}
