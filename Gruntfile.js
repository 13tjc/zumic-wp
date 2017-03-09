'use strict';

/*global module:false*/
module.exports = function(grunt) {
  // show elapsed time at the end
  require('time-grunt')(grunt);
  // load all grunt tasks
  require('load-grunt-tasks')(grunt);

  // configurable paths
  var zumicConfig = {
    app: 'app',
    dist: 'library'
  };

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    zumic: zumicConfig,
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    clean: {
      dist: ['.tmp', '<%= zumic.dist %>/*'],
      server: [
        '.tmp',
        '.sass-cache',
        '<%= zumic.dist %>/scripts/build.txt',
        '<%= zumic.dist %>/scripts/views',
        '<%= zumic.dist %>/scripts/collections',
        '<%= zumic.dist %>/scripts/models',
        '<%= zumic.dist %>/scripts/routes',
        '<%= zumic.dist %>/scripts/templates'
      ]
    },
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      dist: {
        src: ['<%= zumic.app %>/scripts/main.js'],
        dest: '<%= zumic.dist %>/scripts/main.js'
      }
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      dist: {
        src: '<%= concat.dist.dest %>',
        dest: '<%= zumic.dist %>/scripts/<%= pkg.name %>.min.js'
      }
    },
    jshint: {
      options: {
        jshintrc: '.jshintrc',
        reporter: require('jshint-stylish')
      },
      all: [
        'Gruntfile.js',
        '<%= zumic.app %>/scripts/{,*/}*.js',
        '!<%= zumic.app %>/scripts/vendor/*'
      ]
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      },
      libTest: {
        files: '<%= jshint.lib_test.src %>',
        tasks: ['jshint:libTest', 'nodeunit']
      }
    },
    compass: {
      dist: {
        options: {
          sassDir: '<%= zumic.app %>/scss',
          cssDir: '<%= zumic.dist %>/css',
          require: 'susy'
        }
      }
    },
    copy: {
      dist: {
        files: [{
          expand: true,
          dot: true,
          cwd: '<%= zumic.app %>',
          dest: '<%= zumic.dist %>',
          src: [
            '*.{ico,txt,php,html}',
            '.htaccess',
            'images/{,*/}*.{webp,gif}',
            'styles/fonts/{,*/}*.*',
            'js/*.*',
            'fonts/{,*/}*.*'
          ]
        }]
      }
    },
    requirejs: {
      dist: {
        // Options: https://github.com/jrburke/r.js/blob/master/build/example.build.js
        options: {
          baseUrl: '<%= zumic.app %>/scripts',
          dir: '<%= zumic.dist %>/scripts',
          mainConfigFile: '<%= zumic.app %>/scripts/main.js',
          paths: {
            'templates': '../../.tmp/scripts/templates',
            'jquery': 'vendor/jquery/jquery',
            'underscore': 'vendor/underscore/underscore',
            'backbone': 'vendor/backbone/backbone'
          },
          name: 'main',
          optimize: 'none',
          optimizeCss: 'standard',
          // TODO: Figure out how to make sourcemaps work with grunt-usemin
          // https://github.com/yeoman/grunt-usemin/issues/30
          //generateSourceMaps: true,
          // required to support SourceMaps
          // http://requirejs.org/docs/errors.html#sourcemapcomments
          preserveLicenseComments: false,
          useStrict: true
          //uglify2: {} // https://github.com/mishoo/UglifyJS2
        }
      }
    },
    handlebars: {
      compile: {
        options: {
          namespace: 'JST',
          amd: true
        },
        files: {
          '.tmp/scripts/templates.js': ['<%= zumic.app %>/scripts/templates/*.hbs']
        }
      }
    },
    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= zumic.app %>/images',
          src: '{,*/}*.{png,jpg,jpeg}',
          dest: '<%= zumic.dist %>/images'
        }]
      }
    }
  });

  // Default task.
  grunt.registerTask('default', [
    'clean:dist',
    'jshint',
    'compass',
    'handlebars',
    'requirejs',
    // 'concat',
    // 'uglify',
    'imagemin',
    'copy',
    'clean:server'
  ]);
};
