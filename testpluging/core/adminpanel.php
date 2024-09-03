<?php

function acue_courses_admin_menu() {
    add_menu_page(
        'ACUE Courses',
        'ACUE Courses',
        'manage_options',
        'acue-courses',
        'display_acue_courses_page',
        'dashicons-welcome-learn-more',
        6
    );
}
add_action('admin_menu', 'acue_courses_admin_menu');