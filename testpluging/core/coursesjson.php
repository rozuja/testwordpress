<?php


function fetch_acue_courses() {
    $url = 'https://lms.acue.org/ACUE-microcourselist.json';
    
    $response = wp_remote_get($url);
    
    if (is_wp_error($response)) {
        return [];
    }
    
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    
    return $data;
}

function display_acue_courses_page() { 
    $courses = fetch_acue_courses();
    $course_count = count($courses);

    $available_count = 0;

    foreach ($courses as $course) {
    	if ($course['workflow_state'] == 'available') {
    		$available_count++;
    	}
    }
    ?>
    <script>
        jQuery(document).ready(function($){

            $(".togpopup").click(function(){
              $(".popupinfo").toggle();
            });
        });
    </script>
    <style>
        
    </style>
    <div class="togpopup">
        OPEN
    </div>
    <div class="popupinfo">
        <div class="overlay">
            <div class="continfo">
                <p>All courses: <?php echo $course_count ?></p>
               <p>Available Courses: <?php echo $available_count ?></p>
                <div class="togpopup">
                CLOSE
            </div>
            </div>
            
        </div>
    </div>
    <?php 
    

    if (empty($courses)) {
        echo '<p>No courses found.</p>';
        return;
    }
    
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
    
    foreach ($courses as $course) {
        echo '<tr>';
        echo '<td>' . esc_html($course['id']) . '</td>';
        echo '<td>' . esc_html($course['name']) . '</td>';
        echo '<td>' . esc_html($course['course_code']) . '</td>';
        echo '<td>' . esc_html($course['workflow_state']) . '</td>';
        echo '<td>' . substr(esc_html($course['start_at']),0,10) . '</td>';
        echo '<td>' . esc_html($course['end_at']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}