<?php

//Shortcode for frontend

function fetch_json_data_shortcode($atts) {
    // Define the default URL
    $default_url = "https://lms.acue.org/ACUE-microcourselist.json";
    
    // Extract attributes and set default URL if not provided
    $atts = shortcode_atts(
        array(
            'url' => $default_url,  // You can override this by passing the URL as a parameter
        ), 
        $atts,
        'fetch_json_data'
    );

    ob_start();

    // Fetch JSON data
    $response = wp_remote_get($atts['url']);

    // Check if the request was successful
    if (is_wp_error($response)) {
        return 'Unable to retrieve data.';
    }

    // Parse the response
    $data = wp_remote_retrieve_body($response);
    $json_data = json_decode($data, true);

    // Check if JSON is valid
    if (json_last_error() !== JSON_ERROR_NONE) {
        return 'Invalid JSON data.';
    }

    // Pagination parameters
    $items_per_page = 3; // Number of items per page
    $current_page = isset($_GET['paged']) ? intval($_GET['paged']) : 1; // Get the current page or default to 1

    // Calculate total pages
    $total_items = count($json_data);
    $total_pages = ceil($total_items / $items_per_page);

    // Slice the array to get the current page items
    $offset = ($current_page - 1) * $items_per_page;
    $paged_data = array_slice($json_data, $offset, $items_per_page);

    echo '<div class="wrap">';
    echo '<h1>ACUE Courses</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Name</th>';
    echo '<th>Course Code</th>';
    echo '<th>Workflow State</th>';
    echo '<th>Start Date</th>';
    echo '<th>End Date</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Build the output from JSON data (customize as needed)
    foreach ($paged_data as $item) {

        echo '<tr>';
        echo '<td>' . esc_html($item['id']) . '</td>';
        echo '<td>' . esc_html($item['name']) . '</td>';
        echo '<td>' . esc_html($item['course_code']) . '</td>';
        echo '<td>' . esc_html($item['workflow_state']) . '</td>';
        echo '<td>' . esc_html($item['start_at']) . '</td>';
        echo '<td>' . esc_html($item['end_at']) . '</td>';
        echo '</tr>';
    
   }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Pagination links
    if ($total_pages > 1) {
        $output .= '<div class="pagination">';
        if ($current_page > 1) {
            $output .= '<a href="' . esc_url(add_query_arg('paged', $current_page - 1)) . '">&laquo; Previous</a> ';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i == $current_page) ? ' class="current"' : '';
            $output .= '<a' . $class . ' href="' . esc_url(add_query_arg('paged', $i)) . '">' . $i . '</a> ';
        }
        if ($current_page < $total_pages) {
            $output .= '<a href="' . esc_url(add_query_arg('paged', $current_page + 1)) . '">Next &raquo;</a>';
        }
        $output .= '</div>';
    }

    return ob_get_clean();
}

// Register the shortcode
add_shortcode('fetch_json_data', 'fetch_json_data_shortcode');