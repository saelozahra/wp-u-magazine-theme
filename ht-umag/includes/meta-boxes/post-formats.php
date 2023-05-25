<?php

$ht_post_format_audio = array(
	'id'          => 'format-audio',
	'title'       => __('Format: Audio', 'highthemes'),
	'desc'        => __('This option enables you to embed audio into your posts. You must provide both .mp3 and .ogg/.oga file formats in order for self hosted audio to function accross all browsers.', 'highthemes'),
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> __('Audio Code', 'highthemes'),
			'id'		=> '_audio_code',
			'type'		=> 'textarea',
			'rows'		=> '3',
			'desc'		=> __('Put your audio embed code', 'highthemes')
		)
	)
);
$ht_post_format_gallery = array(
	'id'          => 'format-gallery',
	'title'       => __('Format: Gallery', 'highthemes'),
	'desc'        => __('This option enables you to upload multiple images for this page as a gallery.', 'highthemes'),
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
					      array(
					        'label'       => __( 'Gallery', 'highthemes' ),
					        'id'          => 'post-gallery',
					        'type'        => 'gallery',
					        'desc'        => __('Upload multiple images.', 'highthemes'),
					      )

		)
);
$ht_post_format_video = array(
	'id'          => 'format-video',
	'title'       => __('Format: Video', 'highthemes'),
	'desc'        => __('This option enables you to embed videos into your posts.', 'highthemes'),
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> __('Video Embed Code', 'highthemes'),
			'id'		=> '_video_embed_code',
			'type'		=> 'textarea',
			'rows'		=> '2'
		)
	)
);
ot_register_meta_box( $ht_post_format_audio );
ot_register_meta_box( $ht_post_format_gallery );
ot_register_meta_box( $ht_post_format_video );