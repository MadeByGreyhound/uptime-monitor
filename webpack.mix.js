let mix = require('laravel-mix');

mix
	.options({
		processCssUrls: false
	})
	.setPublicPath( 'public' )
	.sass( 'resources/sass/style.scss', 'assets/css' );

if( mix.inProduction() ) {
	mix.version();
}
