<?php
/**
 * ACF Fields and Settings
 */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

if( function_exists('register_field_group') ) {

    register_field_group(array (
    	'key' => 'group_553e4cdaea25c',
    	'title' => 'Episode Settings',
    	'fields' => array (
    		array (
    			'key' => 'field_553e4cee5e1d0',
    			'label' => 'Media',
    			'name' => '',
    			'prefix' => '',
    			'type' => 'tab',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'placement' => 'top',
    		),
    		array (
    			'key' => 'field_553e4d2f5e1d2',
    			'label' => 'Episode File',
    			'name' => 'episode_file',
    			'prefix' => '',
    			'type' => 'file',
    			'instructions' => 'Upload your episodes MP3 (Audio only) or MP4 (Video only) file.',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'id',
    			'library' => 'all',
    			'min_size' => '',
    			'max_size' => '',
    			'mime_types' => 'mp3, mp4',
    		),
    		array (
    			'key' => 'field_553e4cf65e1d1',
    			'label' => 'Externally Hosted Episode File',
    			'name' => 'external_episode_file',
    			'prefix' => '',
    			'type' => 'url',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => 'http://source.com/media/file.mp3',
    		),
    		array (
    			'key' => 'field_553e4d715e1d3',
    			'label' => 'Episode Specifics',
    			'name' => '',
    			'prefix' => '',
    			'type' => 'tab',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'placement' => 'top',
    		),
    		array (
    			'key' => 'field_553e4f4c0eac2',
    			'label' => 'Episode Number',
    			'name' => 'episode_number',
    			'prefix' => '',
    			'type' => 'text',
    			'instructions' => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'maxlength' => '',
    			'readonly' => 0,
    			'disabled' => 0,
    		),
			array (
    			'key' => 'field_553f8380eac2',
    			'label' => 'Episode Subtitle',
    			'name' => 'episode_subtitle',
    			'prefix' => '',
    			'type' => 'text',
    			'instructions' => 'This should be a short one sentence description about this episode.',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'maxlength' => '',
    			'readonly' => 0,
    			'disabled' => 0,
    		),
    		array (
    			'key' => 'field_553e4d7e5e1d4',
    			'label' => 'Explicit',
    			'name' => 'explicit',
    			'prefix' => '',
    			'type' => 'true_false',
    			'instructions' => 'Some podcast directories (iTunes, Pocketcasts) have explicit tags. If this episode contains explicit content/language click the checkbox to enable to explicit tag.',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'message' => '',
    			'default_value' => 0,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'cap_podcast',
    			),
    		),
    	),
    	'menu_order' => 100,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    ));

}
