<?php

class AQS_Search_Handler {
    
    public function search($term) {
        $results = [];
        
        // Search posts
        $posts = $this->search_posts($term);
        if (!empty($posts)) {
            $results['posts'] = $posts;
        }
        
        // Search pages
        $pages = $this->search_pages($term);
        if (!empty($pages)) {
            $results['pages'] = $pages;
        }
        
        // Search users
        if (current_user_can('list_users')) {
            $users = $this->search_users($term);
            if (!empty($users)) {
                $results['users'] = $users;
            }
        }
        
        // Search plugins
        if (current_user_can('activate_plugins')) {
            $plugins = $this->search_plugins($term);
            if (!empty($plugins)) {
                $results['plugins'] = $plugins;
            }
        }
        
        return $results;
    }
    
    private function search_posts($term) {
        $args = [
            's' => $term,
            'post_type' => 'post',
            'post_status' => 'any',
            'posts_per_page' => 5
        ];
        
        $query = new WP_Query($args);
        $results = [];
        
        foreach ($query->posts as $post) {
            $results[] = [
                'title' => $post->post_title,
                'url' => get_edit_post_link($post->ID, 'raw'),
                'type' => 'Post',
                'status' => $post->post_status
            ];
        }
        
        return $results;
    }
    
    private function search_pages($term) {
        $args = [
            's' => $term,
            'post_type' => 'page',
            'post_status' => 'any',
            'posts_per_page' => 5
        ];
        
        $query = new WP_Query($args);
        $results = [];
        
        foreach ($query->posts as $page) {
            $results[] = [
                'title' => $page->post_title,
                'url' => get_edit_post_link($page->ID, 'raw'),
                'type' => 'Page',
                'status' => $page->post_status
            ];
        }
        
        return $results;
    }
    
    private function search_users($term) {
        $args = [
            'search' => '*' . $term . '*',
            'number' => 5
        ];
        
        $user_query = new WP_User_Query($args);
        $results = [];
        
        foreach ($user_query->get_results() as $user) {
            $results[] = [
                'title' => $user->display_name . ' (' . $user->user_email . ')',
                'url' => get_edit_user_link($user->ID),
                'type' => 'User',
                'status' => implode(', ', $user->roles)
            ];
        }
        
        return $results;
    }
    
    private function search_plugins($term) {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        
        $all_plugins = get_plugins();
        $results = [];
        $count = 0;
        
        foreach ($all_plugins as $plugin_file => $plugin_data) {
            if (stripos($plugin_data['Name'], $term) !== false && $count < 5) {
                $results[] = [
                    'title' => $plugin_data['Name'],
                    'url' => admin_url('plugins.php'),
                    'type' => 'Plugin',
                    'status' => is_plugin_active($plugin_file) ? 'Active' : 'Inactive'
                ];
                $count++;
            }
        }
        
        return $results;
    }
}