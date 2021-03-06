<?php
/**
 * Xangô Theme Customizer
 *
 */
include_once get_template_directory() . '/inc/kirki/kirki.php';
/**
 * Configuration sample for the Kirki Customizer
 */
function xango_kirki_config() {
	$args = array(
		'logo_image'   => get_template_directory_uri() . '/assets/images/brasa-customizer.png',
		'url_path'     => get_template_directory_uri() . '/inc/kirki'
	);
	return $args;
}
add_filter( 'kirki/config', 'xango_kirki_config' );

/**
 * Add footer fields
 */
/**
 * Create the setting
 */
function mapa_graffiti_register_section( $wp_customize ) {
	/**
	 * Add sections
	 */
	$wp_customize->add_section( 'header', array(
		'title'       => __( 'Cabeçalho', 'odin' ),
		'priority'    => 10,
	) );
	$wp_customize->add_section( 'footer', array(
		'title'       => __( 'Rodapé', 'odin' ),
		'priority'    => 10,
	) );
}
add_action( 'customize_register', 'mapa_graffiti_register_section' );
function mapa_graffiti_kirki_fields( $fields ) {
	$fields[] = array(
		'type'     => 'text',
		'setting'  => 'featured_btn_txt',
		'label'    => __( 'Texto do botão em destaque no menu', 'odin' ),
		'section'  => 'header',
		'default'  => '',
		'priority' => 1,
	);
	$fields[] = array(
		'type'     => 'text',
		'setting'  => 'featured_btn_link',
		'label'    => __( 'Link do botão em destaque no menu', 'odin' ),
		'section'  => 'header',
		'default'  => '',
		'priority' => 1,
	);

	$fields[] = array(
		'type'     => 'text',
		'setting'  => 'apoiador_link_1',
		'label'    => __( 'Link para o site do apoiador 1', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);
	$fields[] = array(
		'type'     => 'image',
		'setting'  => 'apoiador_img_1',
		'label'    => __( 'Imagem do apoiador 1', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);

	$fields[] = array(
		'type'     => 'text',
		'setting'  => 'apoiador_link_2',
		'label'    => __( 'Link para o site do apoiador 2', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);
	$fields[] = array(
		'type'     => 'image',
		'setting'  => 'apoiador_img_2',
		'label'    => __( 'Imagem do apoiador 2', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);

	$fields[] = array(
		'type'     => 'text',
		'setting'  => 'apoiador_link_3',
		'label'    => __( 'Link para o site do apoiador 3', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);
	$fields[] = array(
		'type'     => 'image',
		'setting'  => 'apoiador_img_3',
		'label'    => __( 'Imagem do apoiador 3', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);

	$fields[] = array(
		'type'     => 'text',
		'setting'  => 'apoiador_link_4',
		'label'    => __( 'Link para o site do apoiador 4', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);
	$fields[] = array(
		'type'     => 'image',
		'setting'  => 'apoiador_img_4',
		'label'    => __( 'Imagem do apoiador 4', 'odin' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 1,
	);

	return $fields;
}
add_filter( 'kirki/fields', 'mapa_graffiti_kirki_fields' );
