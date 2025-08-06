<?php

class AQS_Ajax_Handler {
    
    public function __construct() {
        add_action('wp_ajax_aqs_get_recent', [$this, 'get_recent_items']);
    }
    
    public function get_recent_items() {
        check_ajax_referer('aqs_search_nonce', 'nonce');
        
        $recent = [];
        
        // Get recent posts
        $recent_posts = get_posts([
            'numberposts' => 3,
            'post_status' => 'any'
        ]);
        
        foreach ($recent_posts as $post) {
            $recent[] = [
                'title' => $post->post_title,
                'url' => get_edit_post_link($post->ID, 'raw'),
                'type' => 'Recent Post'
            ];
        }
        
        wp_send_json_success($recent);
    }
}