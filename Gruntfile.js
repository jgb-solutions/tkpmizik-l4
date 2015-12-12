module.exports = function( grunt )
{
	grunt.initConfig(
	{
		jshint: [
			'Gruntfile.js',
			'public/js/bb-search.js',
			'public/js/app.js'
		],

		less: {
			compile: {
				files: {
					'public/css/source/compile.css': 'public/css/source/style.less'
				}
			}
		},

		concat: {
			js: {
				files: {
					'public/js/build/compile.min.js': [
						'public/js/lib/jquery.min.js',
						'public/js/lib/bootstrap.min.js',
						'public/js/lib/underscore.min.js',
						'public/js/lib/backbone.min.js',
						'public/js/source/compile.min.js'
					]
				}
			},

			css: {
				files: {
					'public/css/build/compile.min.css': [
						'public/css/lib/bootstrap.min.css',
						'public/css/lib/font-awesome.min.css',
						'public/css/source/compile.min.css'
					]
				}
			}
		},

		uglify: {
			js: {
				files: {
					'public/js/source/compile.min.js': [
						'public/js/lib/berniecode-animator.js',
						'public/js/lib/soundmanager2.js',
						'public/js/lib/360player.js',
						'public/js/source/bb-search.js',
						'public/js/source/app.js',
					]
				}
			},

			backbone: {
				files: {
					'public/js/lib/backbone.min.js': 'public/js/lib/backbone.js'
				}
			},

			underscore: {
				files: {
					'public/js/lib/underscore.min.js': 'public/js/lib/underscore.js'
				}
			}
		},

		cssmin: {
			css: {
				files: {
					'public/css/source/compile.min.css': [
						'public/css/lib/360player.css',
						'public/css/lib/360player-visualization.css',
						'public/css/source/style.css'
					]
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.registerTask( 'default', ['jshint', 'less', 'uglify', 'cssmin', 'concat'] );
};