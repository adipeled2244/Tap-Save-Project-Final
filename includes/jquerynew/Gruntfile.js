module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: `/**
	<%= pkg.name %> <%= pkg.version %>
	@author <%= pkg.author %>
*/`
			},
			build: {
				src: 'src/<%= pkg.name %>.js',
				dest: 'dist/<%= pkg.name %>.min.js'
			}
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('build', ['uglify']);

	grunt.registerTask('default', ['build']);

};
