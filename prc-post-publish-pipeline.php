<?php
/**
 * PRC Post Publish Pipeline
 *
 * @package           PRC_Post_Publish_Pipeline
 * @author            Seth Rubenstein
 * @copyright         2024 Pew Research Center
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PRC Post Publish Pipeline
 * Plugin URI:        https://github.com/pewresearch/prc-platform
 * Description:       Standardized lifecycle hooks for tracking posts through init, save, publish, update, unpublish, trash, and untrash.
 * Version:           3.2.0
 * Requires at least: 6.8
 * Requires PHP:      8.2
 * Author:            Seth Rubenstein
 * Author URI:        https://pewresearch.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prc-post-publish-pipeline
 * Requires Plugins:  prc-scripts
 */

namespace PRC\Platform\Post_Publish_Pipeline;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'PRC_PRIMARY_SITE_ID' ) ) {
	define( 'PRC_PRIMARY_SITE_ID', 1 );
}
define( 'PRC_POST_PUBLISH_PIPELINE_FILE', __FILE__ );
define( 'PRC_POST_PUBLISH_PIPELINE_DIR', __DIR__ );
define( 'PRC_POST_PUBLISH_PIPELINE_VERSION', '3.2.0' );

/**
 * The core bootstrap class that is used to define the hooks that initialize the various components.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bootstrap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prc_post_publish_pipeline() {
	$plugin = new Bootstrap();
	$plugin->run();
}

/**
 * Enqueue an async tier lifecycle event for a post.
 *
 * @param int    $post_id Post ID.
 * @param string $event   Lifecycle event: publish, update, unpublish, untrash, trash, or incremental_save.
 */
function enqueue_async_event( int $post_id, string $event ): void {
	Bootstrap::enqueue_async_event( $post_id, $event );
}

run_prc_post_publish_pipeline();
