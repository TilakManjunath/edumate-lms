<?php
function edumate_add_course_meta_box() {
    add_meta_box('course_meta', 'Course Details', 'edumate_course_meta_callback', 'course');
}
add_action('add_meta_boxes', 'edumate_add_course_meta_box');

function edumate_course_meta_callback($post) {
    $duration = get_post_meta($post->ID, '_duration', true);
    $difficulty = get_post_meta($post->ID, '_difficulty', true);
    ?>
    <p><label>Duration:</label>
    <input type="text" name="duration" value="<?= esc_attr($duration); ?>" /></p>

    <p><label>Difficulty:</label>
    <select name="difficulty">
        <option value="Beginner" <?= selected($difficulty, 'Beginner'); ?>>Beginner</option>
        <option value="Intermediate" <?= selected($difficulty, 'Intermediate'); ?>>Intermediate</option>
        <option value="Advanced" <?= selected($difficulty, 'Advanced'); ?>>Advanced</option>
    </select></p>
    <?php
}

function edumate_save_course_meta($post_id) {
    if (array_key_exists('duration', $_POST)) {
        update_post_meta($post_id, '_duration', sanitize_text_field($_POST['duration']));
    }
    if (array_key_exists('difficulty', $_POST)) {
        update_post_meta($post_id, '_difficulty', sanitize_text_field($_POST['difficulty']));
    }
}
add_action('save_post', 'edumate_save_course_meta');
