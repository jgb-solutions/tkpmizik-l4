module.exports = function(grunt) {
	grunt.initConfig(
	{
		jshint: [
			'Gruntfile.js',
			'app/assets/js/source/bb-search.js',
			'app/assets/js/source/contact.js',
			'app/assets/js/source/app.js'
		],

		less: {
			compile: {
				files: {
					'app/assets/css/source/style.css': 'app/assets/css/source/style.less'
				}
			}
		},

		concat: {
			js: {
				files: {
					'public/js/app.nice.js': [
						'app/assets/js/lib/jquery.min.js',
						'app/assets/js/lib/jquery.form.min.js',
						'app/assets/js/lib/bootstrap.min.js',
						//'app/assets/js/lib/underscore.min.js',
						//'app/assets/js/lib/backbone.min.js',
						'app/assets/js/lib/jquery.lazyload.min.js',
						'app/assets/js/compile.min.js'
					]
				}
			},

			css: {
				files: {
					'public/css/app.css': [
						'app/assets/css/lib/bootstrap.min.css',
						'app/assets/css/compile.min.css'
					]
				}
			},

			css_all: {
				files: {
					'public/css/all.css': [
						'app/assets/css/lib/bootstrap.min.css',
						'app/assets/css/lib/font-awesome.min.css',
						'app/assets/css/compile.min.css'
					]
				}
			}
		},

		uglify: {
			js: {
				files: {
					'app/assets/js/compile.min.js': [
						'app/assets/js/lib/berniecode-animator.js',
						'app/assets/js/lib/soundmanager2.js',
						'app/assets/js/lib/360player.js',
						//'app/assets/js/source/bb-search.js',
						'app/assets/js/source/jquery-search.js',
						'app/assets/js/source/app.js',
					]
				}
			}
		},

		cssmin: {
			css: {
				files: {
					'app/assets/css/compile.min.css': [
						'app/assets/css/lib/360player.css',
						'app/assets/css/lib/360player-visualization.css',
						'app/assets/css/source/style.css'
					]
				}
			}
		},

		watch: {
			files: ['app/assets/js/source/*.js', 'app/assets/css/source/*.less'],
			tasks: ['less', 'jshint', 'uglify', 'cssmin', 'concat']
		}
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask( 'default', ['jshint', 'less', 'uglify', 'cssmin', 'concat'] );
};