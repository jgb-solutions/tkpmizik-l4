module.exports = function(grunt)
{
	grunt.initConfig(
	{
		jshint: [
			'Gruntfile.js',
			'public/js/source/bb-search.js',
			'public/js/source/app.js'
		],

		concat: {
			js: {
				files: {
					'public/js/app.js': [
						'public/js/lib/jquery.min.js',
						'public/js/lib/jquery.form.min.js',
						'public/js/lib/bootstrap.min.js',
						'public/js/lib/underscore.min.js',
						'public/js/lib/backbone.min.js',
						'public/js/lib/jquery.lazyload.min.js',
						'public/js/compile.min.js'
					]
				}
			},

			css: {
				files: {
					'public/css/app.css': [
						'public/css/lib/bootstrap.min.css',
						'public/css/compile.min.css'
					]
				}
			},

			css_all: {
				files: {
					'public/css/all.css': [
						'public/css/lib/bootstrap.min.css',
						'public/css/lib/font-awesome.min.css',
						'public/css/compile.min.css'
					]
				}
			}
		},

		uglify: {
			js: {
				files: {
					'public/js/compile.min.js': [
						'public/js/lib/berniecode-animator.js',
						'public/js/lib/soundmanager2.js',
						'public/js/lib/360player.js',
						'public/js/source/bb-search.js',
						'public/js/source/app.js',
					]
				}
			}
		},

		cssmin: {
			css: {
				files: {
					'public/css/compile.min.css': [
						'public/css/lib/360player.css',
						'public/css/lib/360player-visualization.css',
						'public/css/source/style.css'
					]
				}
			}
		},

		watch: {
			files: ['public/js/source/*.js', 'public/css/source/*.css'],
			tasks: ['jshint', 'uglify', 'cssmin', 'concat']
		}
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	//grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	//grunt.loadNpmTasks('grunt-uncss');

	grunt.registerTask( 'default', ['jshint', 'uglify', 'cssmin', 'concat'] );
};