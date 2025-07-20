<?php
function edumate_course_list_shortcode() {
    $query = new WP_Query([
        'post_type' => 'course',
        'posts_per_page' => -1
    ]);

    $output = '<div class="edumate-course-list">';
    while ($query->have_posts()) {
        $query->the_post();
        $duration = get_post_meta(get_the_ID(), '_duration', true);
        $difficulty = get_post_meta(get_the_ID(), '_difficulty', true);

        $output .= '<div style="border:1px solid #ccc;padding:10px;margin:10px 0">';
        $output .= '<h3>' . get_the_title() . '</h3>';
        $output .= '<p><strong>Duration:</strong> ' . esc_html($duration) . '</p>';
        $output .= '<p><strong>Difficulty:</strong> ' . esc_html($difficulty) . '</p>';
        $output .= '<a href="' . get_permalink() . '">Enroll Now</a>';
        $output .= '</div>';
    }
    wp_reset_postdata();
    $output .= '</div>';

    return $output;
}
add_shortcode('edumate_courses', 'edumate_course_list_shortcode');
