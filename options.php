<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

function cap_podcast_settings_layout() {
    $screen = get_current_screen();
    if ( 'toplevel_page_acf-options' == $screen->base ): ?>
	<style type="text/css">
        #podcast-options-top {
            display: table;
            width: 100%;
        }
        #podcast-options-top > div {
            display: table-cell;
            padding: 15px 12px;
        }
        #podcast-options-top > div:first-of-type {
            width: 150px;
            border-right: 1px solid #eaeaea;
        }
        .acf-field-553fd9079a843 {
            margin-bottom: 0px;
        }
	</style>

	<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.acf-field-553fd8179a83b').wrap('<div id="podcast-options-top"></div>');
        jQuery('.acf-field-553fd8179a83b').wrap('<div></div>');

        jQuery('.acf-field-553fd8319a83c').appendTo('#podcast-options-top');
        jQuery('.acf-field-553fd8319a83c').wrap('<div class="podcast-options-right"></div>');
        jQuery('.acf-field-553fd8609a83e').appendTo('.podcast-options-right');
        jQuery('.acf-field-553fd9079a843').appendTo('.podcast-options-right');
    });
	</script>
	<?php endif;
}

add_action('acf/input/admin_head', 'cap_podcast_settings_layout');


if( function_exists('register_field_group') ) {

	register_field_group(array (
		'key' => 'group_553fd79f40124',
		'title' => 'Podcast Settings',
		'fields' => array (
			array (
				'key' => 'field_553fd8179a83b',
				'label' => 'Podcast Album Art',
				'name' => 'podcast_album_art',
				'prefix' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_553fd8319a83c',
				'label' => 'Podcast Name',
				'name' => 'podcast_name',
				'prefix' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
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
				'key' => 'field_553fd8609a83e',
				'label' => 'Podcast Subtitle',
				'name' => 'podcast_subtitle',
				'prefix' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
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
				'key' => 'field_553fd9079a843',
				'label' => 'Podcast Categories',
				'name' => 'podcast_categories',
				'prefix' => '',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'Arts' => 'Arts',
					'Business' => 'Business',
					'Comedy' => 'Comedy',
					'Education' => 'Education',
					'Games & Hobbies' => 'Games & Hobbies',
					'Government & Organizations' => 'Government & Organizations',
					'Health' => 'Health',
					'Music' => 'Music',
					'News & Politics' => 'News & Politics',
					'Religion & Spirituality' => 'Religion & Spirituality',
					'Science & Medicine' => 'Science & Medicine',
					'Society & Culture' => 'Society & Culture',
					'Sports & Recreation' => 'Sports & Recreation',
					'TV & Film' => 'TV & Film',
					'Technology' => 'Technology',
				),
				'default_value' => array (
					'' => '',
				),
				'allow_null' => 0,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 1,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_553fd8389a83d',
				'label' => 'Podcast Description',
				'name' => 'podcast_description',
				'prefix' => '',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_553fd8979a83f',
				'label' => 'Copyright',
				'name' => 'podcast_copyright',
				'prefix' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
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
				'key' => 'field_553fd8c09a840',
				'label' => 'Explicit',
				'name' => 'podcast_explicit',
				'prefix' => '',
				'type' => 'true_false',
				'instructions' => '',
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
			array (
				'key' => 'field_553fd8d99a841',
				'label' => 'Podcast Author',
				'name' => 'podcast_author',
				'prefix' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => 50,
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
				'key' => 'field_553fd8e59a842',
				'label' => 'Podcast Author Email',
				'name' => 'podcast_author_email',
				'prefix' => '',
				'type' => 'email',
				'instructions' => 'Required for iTunes listing',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => 50,
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_5540e9c197cb9',
				'label' => 'iTunes Podcast Directory LInk',
				'name' => 'itunes_podcast_directory_link',
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
				'placeholder' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));

}
