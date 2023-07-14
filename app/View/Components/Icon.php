<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
	/**
	 * @var string Icon to display.
	 */
	public string $icon;

	/**
	 * @var string Icon path.
	 */
	public string $path;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( string $icon ) {
		$this->icon = $icon;
		$this->path = resource_path( "icons/{$this->icon}.svg" );
	}

	public function shouldRender(): bool
	{
		return file_exists( $this->path );
	}

	/**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): string
    {
        return trim( file_get_contents( $this->path ) );
    }
}
