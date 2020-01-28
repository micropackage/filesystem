<?php
/**
 * Class TestFilesystem
 *
 * @package micropackage/filesystem
 */

namespace Micropackage\Filesystem\Test;

use Micropackage\Filesystem\Filesystem;

/**
 * Filesystem test case.
 */
class TestFilesystem extends \WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->base_dir          = WP_PLUGIN_DIR . '/test/';
		$this->plugin_filesystem = new Filesystem( $this->base_dir );
	}

	public function test_path() {
		$this->assertSame(
			$this->base_dir . 'dir/file.php',
			$this->plugin_filesystem->path( 'dir/file.php' )
		);
	}

	public function test_path_base() {
		$this->assertSame(
			$this->base_dir,
			$this->plugin_filesystem->path()
		);
	}

	public function test_url() {
		$this->assertSame(
			WP_PLUGIN_URL . '/test/dir/file.png',
			$this->plugin_filesystem->url( 'dir/file.png' )
		);
	}

	public function test_url_base() {
		$this->assertSame(
			WP_PLUGIN_URL . '/test/',
			$this->plugin_filesystem->url()
		);
	}

}
