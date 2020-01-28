<?php
/**
 * Filesystem class
 *
 * @package micropackage/filesystem
 */

namespace Micropackage\Filesystem;

/**
 * Filesystem class
 *
 * @see Available methods: https://developer.wordpress.org/reference/classes/wp_filesystem_base/#methods
 */
class Filesystem {

	/**
	 * Base directory with trailing slash
	 *
	 * @var string
	 */
	protected $base_dir;

	/**
	 * WP Filesystem object
	 *
	 * @var WP_Filesystem_*
	 */
	protected $wp_filesystem;

	/**
	 * WP_Filesystem's methods
	 * which doesn't expect the relative paths
	 *
	 * @var array
	 */
	private $prefixed_methods = [
		'find_folder',
		'search_for_folder',
		'gethchmod',
		'getchmod',
		'chown',
		'get_contents',
		'get_contents_array',
		'put_contents',
		'chdir',
		'chgrp',
		'chmod',
		'owner',
		'group',
		'delete',
		'exists',
		'is_file',
		'is_dir',
		'is_readable',
		'is_writeable',
		'atime',
		'mtime',
		'size',
		'touch',
		'mkdir',
		'rmdir',
		'dirlist',
	];

	/**
	 * Filesystem constructor
	 *
	 * @since 1.0.0
	 * @param string $base_dir Absolute path to the base dir.
	 */
	public function __construct( $base_dir ) {

		$this->base_dir = trailingslashit( wp_normalize_path( $base_dir ) );

		$this->init_wp_filesystem();

	}

	/**
	 * Initializes the WP_Filesystem
	 *
	 * @since  1.0.0
	 * @return void
	 */
	private function init_wp_filesystem() {

		global $wp_filesystem;

		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();

		$this->wp_filesystem = $wp_filesystem;

	}

	/**
	 * Passes the method call to the WP_Filesystem
	 *
	 * @since  1.0.0
	 * @param  string $method_name Called method name.
	 * @param  array  $arguments   List of arguments passed.
	 * @return mixed
	 */
	public function __call( $method_name, $arguments ) {

		// Prefix file/dir with base path for certain methods.
		if ( in_array( $method_name, $this->prefixed_methods, true ) ) {
			if ( ! isset( $arguments[0] ) ) {
				$arguments[0] = '';
			}
			$arguments[0] = $this->base_path() . $arguments[0];
		}

		return call_user_func_array( [ $this->wp_filesystem, $method_name ], $arguments );

	}

	/**
	 * Changes the path to URL
	 *
	 * @since  1.0.0
	 * @param  string $path Full path.
	 * @return string
	 */
	public function path_to_url( $path ) {
		return str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $path );
	}

	/**
	 * Gets the base url
	 *
	 * @since  1.0.0
	 * @return string
	 */
	protected function base_url() {
		return $this->path_to_url( $this->base_dir );
	}

	/**
	 * Replaces relative path to full path
	 *
	 * @since  1.0.0
	 * @param  string $rel_path Relative path to file or dir.
	 * @return string
	 */
	public function path( $rel_path = '' ) {
		return $this->base_dir . $rel_path;
	}

	/**
	 * Replaces relative URI to full URL
	 *
	 * @since  1.0.0
	 * @param  string $uri Relative URI.
	 * @return string
	 */
	public function url( $uri = '' ) {
		return $this->base_url() . $uri;
	}

	/**
	 * Converts image file to base64 URL
	 *
	 * @since  1.0.0
	 * @param  string $image_path Relative image path.
	 * @return string
	 */
	public function image_to_base64( $image_path ) {

		if ( ! $this->exists( $image_path ) ) {
			return '';
		}

		$type = pathinfo( $this->path( $image_path ), PATHINFO_EXTENSION );

		// SVG mime type fix.
		if ( 'svg' === $type ) {
			$type = 'svg+xml';
		}

		return sprintf(
			'data:image/%s;base64,%s',
			$type,
			base64_encode( $this->get_contents( $image_path ) ) // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
		);

	}

}
