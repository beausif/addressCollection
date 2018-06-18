module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            dataTablesJS: {
                options: {
                    separator: ';'
                },
                src: [
                    'node_modules/datatables.net/js/jquery.dataTables.js',
                    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js'],
                dest: 'html/assets/js/dataTables.js'
            },
            dataTablesCSS: {
                src: [
                    'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'],
                dest: 'html/assets/css/dataTables.css'
            },
            commonCSS: {
                src: [
                    'node_modules/bootstrap/dist/css/bootstrap.css'],
                dest: 'html/assets/css/common.css'
            },
            commonJS: {
                options: {
                    separator: ';'
                },
                src: [
                    'node_modules/jquery/dist/jquery.js',
                    'node_modules/jquery-validation/dist/jquery.validate.js',
                    'node_modules/popper.js/dist/umd/popper.js',
                    'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
                    'html/assets/js/global.js'],
                dest: 'html/assets/js/common.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
            },
            prod: {
                files: {
                    'html/assets/js/dataTables.min.js': ['<%= concat.dataTablesJS.dest %>'],
                    'html/assets/js/common.min.js': ['<%= concat.commonJS.dest %>']
                }
            }

        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'html/assets/css/dataTables.min.css': ['<%= concat.dataTablesCSS.dest %>'],
                    'html/assets/css/common.min.css': ['<%= concat.commonCSS.dest %>']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['concat', 'uglify', 'cssmin']);
};