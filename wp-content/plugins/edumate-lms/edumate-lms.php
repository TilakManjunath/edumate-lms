<?php
/*
Plugin Name: EduMate LMS
Description: Custom LMS functionality for EduMate (shortcodes, student role, login/register, enrollments)
Version: 1.0
Author: Tilak Manjunath
*/
// Fix invalid "From" email header
add_filter('wp_mail_from', function() {
    return 'noreply@edumate.local'; // You can use any valid-looking email
});
add_filter('wp_mail_from_name', function() {
    return 'EduMate LMS';
});


// 1. Add 'student' role
function edumate_add_student_role() {
    if (!get_role('student')) {
        add_role('student', 'Student', [
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false
        ]);
    }
}
add_action('init', 'edumate_add_student_role');

// 2. Set default role as 'student' on registration
function edumate_set_default_role_on_registration($user_id) {
    $user = new WP_User($user_id);
    $user->set_role('student');
}
add_action('user_register', 'edumate_set_default_role_on_registration');

// 3. Register 'course' custom post type
function edumate_register_course_post_type() {
    register_post_type('edumate_course', [
        'labels' => [
            'name' => 'Courses',
            'singular_name' => 'Course'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'courses'],
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt']
    ]);
}
add_action('init', 'edumate_register_course_post_type');

// 4. Shortcode: Student Dashboard
function edumate_student_dashboard_shortcode() {
    if (!is_user_logged_in()) {
        return '<p>Please <a href="/login">login</a> to view your dashboard.</p>';
    }

    $current_user = wp_get_current_user();
    if (in_array('student', $current_user->roles)) {
        $output = "<div class='edumate-dashboard'>";
        $output .= "<h3>Welcome, " . esc_html($current_user->display_name) . "</h3>";
        $output .= "<p>This is your student dashboard.</p>";

        // Show enrolled courses
        $enrolled = get_user_meta($current_user->ID, 'enrolled_courses', true);
        if (!empty($enrolled) && is_array($enrolled)) {
            $output .= "<h4>Your Enrolled Courses:</h4><ul>";
            foreach ($enrolled as $course_id) {
                $output .= "<li><a href='" . get_permalink($course_id) . "'>" . get_the_title($course_id) . "</a></li>";
            }
            $output .= "</ul>";
        } else {
            $output .= "<p>You haven't enrolled in any courses yet.</p>";
        }

        $output .= "</div>";
        return $output;
    } else {
        return "<p>Access restricted to students.</p>";
    }
}
add_shortcode('edumate_student_dashboard', 'edumate_student_dashboard_shortcode');

// 5. Shortcode: Display all courses
function edumate_courses_shortcode() {
    $args = ['post_type' => 'edumate_course', 'posts_per_page' => -1];
    $courses = new WP_Query($args);
    $output = '<div class="edumate-courses">';

    if ($courses->have_posts()) {
        while ($courses->have_posts()) {
            $courses->the_post();
            $enroll_url = esc_url(admin_url('admin-post.php')) . '?action=edumate_enroll&course_id=' . get_the_ID();
            $output .= '<div class="course">';
            $output .= '<h2 class="course-title">' . get_the_title() . '</h2>';
            $output .= '<p class="course-excerpt">' . get_the_excerpt() . '</p>';
            $output .= '<a href="' . $enroll_url . '" class="enroll-button">Enroll</a>';
            $output .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>No courses available.</p>';
    }

    $output .= '</div>';
    return $output;
}
add_shortcode('edumate_courses', 'edumate_courses_shortcode');

// 6. Handle enrollment request
function edumate_handle_enroll() {
    if (!is_user_logged_in() || !isset($_GET['course_id'])) {
        wp_redirect(home_url('/login'));
        exit;
    }

    $user_id = get_current_user_id();
    $course_id = intval($_GET['course_id']);
    $enrolled = get_user_meta($user_id, 'enrolled_courses', true);
    if (!is_array($enrolled)) $enrolled = [];

    if (!in_array($course_id, $enrolled)) {
        $enrolled[] = $course_id;
        update_user_meta($user_id, 'enrolled_courses', $enrolled);

        // ✅ Send email after enrollment
        $user_info = get_userdata($user_id);
        $course_title = get_the_title($course_id);
        $to = $user_info->user_email;
        $subject = "Enrolled in $course_title";
        $message = "Hi " . $user_info->first_name . ",\n\nYou have successfully enrolled in the course: \"$course_title\".\n\nVisit your dashboard to get started.\n\nHappy Learning!\nEduMate Team";
        wp_mail($to, $subject, $message);
    }

    wp_redirect(get_permalink($course_id));
    exit;
}
add_action('admin_post_edumate_enroll', 'edumate_handle_enroll');
add_action('admin_post_nopriv_edumate_enroll', 'edumate_handle_enroll');


// 7. Enqueue custom LMS styles
function edumate_enqueue_styles() {
    wp_enqueue_style('edumate-style', plugin_dir_url(__FILE__) . 'edumate-style.css');
}
add_action('wp_enqueue_scripts', 'edumate_enqueue_styles');

function edumate_send_welcome_email($user_id) {
    $user = get_userdata($user_id);
    $to = $user->user_email;
    $subject = "Welcome to EduMate!";
    $message = "Hi " . $user->first_name . ",\n\nWelcome to EduMate – your learning journey starts now!\n\nLogin and enroll in a course to get started.\n\nRegards,\nEduMate Team";
    wp_mail($to, $subject, $message);
}
add_action('user_register', 'edumate_send_welcome_email');
