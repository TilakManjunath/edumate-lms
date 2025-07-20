<?php
function edumate_register_post_types() {
    // Course Post Type
    register_post_type('course', [
        'labels' => [
            'name' => 'Courses',
            'singular_name' => 'Course'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-welcome-learn-more'
    ]);

    // Lesson Post Type
    register_post_type('lesson', [
        'labels' => [
            'name' => 'Lessons',
            'singular_name' => 'Lesson'
        ],
        'public' => true,
        'has_archive' => false,
        'supports' => ['title', 'editor'],
        'menu_icon' => 'dashicons-welcome-write-blog'
    ]);
}
add_action('init', 'edumate_register_post_types');
