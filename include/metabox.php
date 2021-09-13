<?php

/*
	
@package DevelopersHub
	
	========================
		CUSTOM METABOX
	========================
*/

//Add Custom Metabox

function job_custom_metabox(){
    $screens = [ 'job', 'job_cpt' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'job_data-metabox', //Uniqe ID
            'Job Data', //Box Title
            'job_custom_metabox_callback', //Content callback (must be of type callable)
            $screen //Post type
        );
    }
}
add_action('add_meta_boxes', 'job_custom_metabox');
 
function job_custom_metabox_callback(){
     
    global $post;
     
    ?>
		<table>
			<tr>
				<td><label for="_job_location"><b>Location</b></label></td>
				<td><label for="_job_salary"><b>Salary</b></label></td>
				<td><label for="_job_duration"><b>Timings</b></label></td>
			</tr>
			<tr>
				<td><input type="text" name="_job_location" id="_job_location" value="<?php echo get_post_meta($post->ID, 'job_location', true)?>" placeholder="Job Location"/></td>
				<td><input type="text" name="_job_salary" value="<?php echo get_post_meta($post->ID, 'job_salary', true)?>" placeholder="Job Salary"/></td>
				<td><input type="text" name="_job_duration" value="<?php echo get_post_meta($post->ID, 'job_duration', true)?>" placeholder="Job Duration"/></td>
			</tr>
		</table>
    <?php
}
 
function job_save_custom_metabox(){
 
    global $post;
 
    if(isset($_POST["_job_location"])):
        update_post_meta($post->ID, 'job_location', $_POST["_job_location"]);
    endif;

    if(isset($_POST["_job_salary"])):
        update_post_meta($post->ID, 'job_salary', $_POST["_job_salary"]);
    endif;

    if(isset($_POST["_job_duration"])):
        update_post_meta($post->ID, 'job_duration', $_POST["_job_duration"]);
    endif;
}
add_action('save_post', 'job_save_custom_metabox');