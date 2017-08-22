<?php
/* ACF Custom Fields */
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_localizacao',
		'title' => 'Localização',
		'fields' => array (
			array (
				'key' => 'field_5769a0c46d247',
				'label' => 'Selecione a Localização no Mapa',
				'name' => 'map',
				'type' => 'google_map',
				'center_lat' => '-23.533773',
				'center_lng' => '-46.625290',
				'zoom' => 5,
				'height' => 400,
			),
			array (
				'key' => 'field_5769a2927aafe',
				'label' => 'Endereço',
				'name' => 'address',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'pins',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_link-para-o-video',
		'title' => 'Link para o vídeo',
		'fields' => array (
			array (
				'key' => 'field_57b656068495f',
				'label' => 'Link para o vídeo',
				'name' => 'video_embed',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_media',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/* odin metabox */
$galeria_metabox = new Odin_Metabox(
    'galeria', // Slug/ID do Metabox (obrigatório)
    'Galeria', // Nome do Metabox  (obrigatório)
    'pins', // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)
    'normal', // Contexto (opções: normal, advanced, ou side) (opcional)
    'high' // Prioridade (opções: high, core, default ou low) (opcional)
);
$galeria_metabox->set_fields(
    array(
    	array(
    		'id'          => 'galeria', // Obrigatório
    		'label'       => __( 'Galeria de imagens', 'odin' ), // Obrigatório
    		'type'        => 'image_plupload', // Obrigatório
    	)
    )
);
