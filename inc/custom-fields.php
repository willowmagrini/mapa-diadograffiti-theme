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
	register_field_group(array (
		'id' => 'acf_tipo-de-evento',
		'title' => 'Tipo de evento',
		'fields' => array (
			array (
				'key' => 'field_5769a310eccd5',
				'label' => 'Selecione o tipo de evento',
				'name' => 'event_type',
				'type' => 'radio',
				'choices' => array (
					'oficial' => 'Evento do Dia do Graffiti',
					'externo' => 'Evento externo',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
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
			'position' => 'side',
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
		'id' => 'acf_ano-do-evento',
		'title' => 'Ano do Evento',
		'fields' => array (
			array (
				'key' => 'field_5772c53884584',
				'label' => 'Ano do Evento',
				'name' => 'event_year',
				'type' => 'text',
				'required' => 1,
				'default_value' => date( 'Y' ),
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
			'position' => 'side',
			'layout' => 'default',
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
