<?php
/**
 * Plugin Name: Admin Quick Search
 * Plugin URI: https://github.com/ghouliaras/admin-quick-search
 * Description: Adds a universal quick search bar to WordPress admin for faster navigation
 * Version: 1.0.0
 * Author: Ghouliaras
 * License: GPL v2 or later
 * Text Domain: admin-quick-search
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('AQS_VERSION', '1.0.0');
define('AQS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AQS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load required files
require_once AQS_PLUGIN_DIR . 'includes/class-search-handler.php';
require_once AQS_PLUGIN_DIR . 'includes/class-ajax-handler.php';

class Admin_Quick_Search {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('admin_footer', [$this, 'render_search_modal']);
        add_action('wp_ajax_aqs_search', [$this, 'handle_ajax_search']);
        
        // Add admin menu
        add_action('admin_menu', [$this, 'add_admin_menu']);
        
        // Add admin bar item
        add_action('admin_bar_menu', [$this, 'add_admin_bar_item'], 100);
        
        // Initialize handlers
        new AQS_Search_Handler();
        new AQS_Ajax_Handler();
    }
    
    public function enqueue_admin_assets() {
        wp_enqueue_style(
            'aqs-admin-style',
            AQS_PLUGIN_URL . 'assets/css/admin-search.css',
            [],
            AQS_VERSION
        );
        
        wp_enqueue_script(
            'aqs-admin-script',
            AQS_PLUGIN_URL . 'assets/js/admin-search.js',
            ['jquery'],
            AQS_VERSION,
            true
        );
        
        wp_localize_script('aqs-admin-script', 'aqs_ajax', [
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('aqs_search_nonce')
        ]);
    }
    
    public function render_search_modal() {
        ?>
        <div id="aqs-modal" class="aqs-modal">
            <div class="aqs-modal-content">
                <input type="text" id="aqs-search-input" placeholder="Quick search (Ctrl+K or Cmd+K)..." />
                <div id="aqs-results"></div>
            </div>
        </div>
        <?php
    }
    
    public function add_admin_menu() {
        add_menu_page(
            'Quick Search',
            'Quick Search',
            'read',
            'admin-quick-search',
            [$this, 'render_admin_page'],
            'dashicons-search',
            3
        );
    }
    
    public function render_admin_page() {
        ?>
        <div class="wrap">
            <h1>Admin Quick Search</h1>
            <div class="aqs-admin-page">
                <div class="card">
                    <h2>How to Use Quick Search</h2>
                    <p>Quick Search helps you navigate your WordPress admin faster than ever!</p>
                    
                    <h3>Opening Search</h3>
                    <ul>
                        <li><strong>Keyboard Shortcut:</strong> Press <code>Ctrl+K</code> (Windows/Linux) or <code>Cmd+K</code> (Mac)</li>
                        <li><strong>Admin Bar:</strong> Click the search icon in the admin bar</li>
                        <li><strong>Button:</strong> Click the button below</li>
                    </ul>
                    
                    <button class="button button-primary button-hero" onclick="jQuery('#aqs-modal').addClass('active'); jQuery('#aqs-search-input').focus();">
                        <span class="dashicons dashicons-search"></span> Open Quick Search
                    </button>
                    
                    <h3>Search Features</h3>
                    <ul>
                        <li>✓ Search posts, pages, users, and plugins</li>
                        <li>✓ Real-time results as you type</li>
                        <li>✓ Keyboard navigation (arrow keys + Enter)</li>
                        <li>✓ Direct links to edit screens</li>
                    </ul>
                    
                    <h3>Keyboard Shortcuts</h3>
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Windows/Linux</th>
                                <th>Mac</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Open Search</td>
                                <td><code>Ctrl + K</code></td>
                                <td><code>Cmd + K</code></td>
                            </tr>
                            <tr>
                                <td>Navigate Results</td>
                                <td><code>↑ ↓ Arrow Keys</code></td>
                                <td><code>↑ ↓ Arrow Keys</code></td>
                            </tr>
                            <tr>
                                <td>Select Result</td>
                                <td><code>Enter</code></td>
                                <td><code>Enter</code></td>
                            </tr>
                            <tr>
                                <td>Close Search</td>
                                <td><code>Escape</code></td>
                                <td><code>Escape</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="card">
                    <h2>Statistics</h2>
                    <?php
                    $post_count = wp_count_posts();
                    $page_count = wp_count_posts('page');
                    $user_count = count_users();
                    
                    if (!function_exists('get_plugins')) {
                        require_once ABSPATH . 'wp-admin/includes/plugin.php';
                    }
                    $plugin_count = get_plugins();
                    ?>
                    <p>Quick Search can help you find:</p>
                    <ul>
                        <li><strong><?php echo esc_html( $post_count->publish ); ?></strong> published posts</li>
                        <li><strong><?php echo esc_html( $page_count->publish ); ?></strong> published pages</li>
                        <li><strong><?php echo esc_html( $user_count['total_users'] ); ?></strong> users</li>
                        <li><strong><?php echo esc_html( count($plugin_count) ); ?></strong> installed plugins</li>
                    </ul>
                </div>
            </div>
        </div>
        <style>
            .aqs-admin-page { margin-top: 20px; }
            .aqs-admin-page .card { max-width: 800px; padding: 20px; margin-bottom: 20px; }
            .aqs-admin-page code { background: #f0f0f0; padding: 2px 6px; border-radius: 3px; }
            .aqs-admin-page .button-hero { height: 50px; line-height: 48px; padding: 0 30px; font-size: 16px; }
            .aqs-admin-page .dashicons { line-height: 48px; font-size: 20px; margin-right: 5px; }
        </style>
        <?php
    }
    
    public function add_admin_bar_item($wp_admin_bar) {
        if (!is_admin()) {
            return;
        }
        
        $args = [
            'id' => 'aqs-search',
            'title' => '<span class="ab-icon dashicons dashicons-search"></span><span class="ab-label">Quick Search</span>',
            'href' => '#',
            'meta' => [
                'title' => 'Quick Search (Ctrl+K / Cmd+K)',
                'onclick' => 'jQuery("#aqs-modal").addClass("active"); jQuery("#aqs-search-input").focus(); return false;'
            ]
        ];
        
        $wp_admin_bar->add_node($args);
    }
    
    public function handle_ajax_search() {
        check_ajax_referer('aqs_search_nonce', 'nonce');
        
        $search_term = isset($_POST['search']) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        
        if (empty($search_term)) {
            wp_die();
        }
        
        $handler = new AQS_Search_Handler();
        $results = $handler->search($search_term);
        
        wp_send_json_success($results);
    }
}

// Initialize the plugin
add_action('plugins_loaded', function() {
    Admin_Quick_Search::get_instance();
});