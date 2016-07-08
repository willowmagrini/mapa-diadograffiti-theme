<?php
if ( ! function_exists('diadoagraffiti_map_custom_types') ) {

// Register Custom Post Type
function diadoagraffiti_map_custom_types() {

	$labels = array(
		'name'                  => _x( 'Pins', 'Post Type General Name', 'odin' ),
		'singular_name'         => _x( 'Pin', 'Post Type Singular Name', 'odin' ),
		'menu_name'             => __( 'Pins', 'odin' ),
		'name_admin_bar'        => __( 'Pins', 'odin' ),
		'archives'              => __( 'Pins', 'odin' ),
		'parent_item_colon'     => __( 'Pin relacionado', 'odin' ),
		'all_items'             => __( 'Todos Pins', 'odin' ),
		'add_new_item'          => __( 'Adicionar novo Pin', 'odin' ),
		'add_new'               => __( 'Adicionar novo', 'odin' ),
		'new_item'              => __( 'Novo Pin', 'odin' ),
		'edit_item'             => __( 'Editar Pin', 'odin' ),
		'update_item'           => __( 'Atualizar Pin', 'odin' ),
		'view_item'             => __( 'Ver Pin', 'odin' ),
		'search_items'          => __( 'Buscar Pin', 'odin' ),
		'not_found'             => __( 'Não encontrado', 'odin' ),
		'not_found_in_trash'    => __( 'Não encontrado na lixeira', 'odin' ),
		'featured_image'        => __( 'Imagem destacada', 'odin' ),
		'set_featured_image'    => __( 'Setar imagem destacada', 'odin' ),
		'remove_featured_image' => __( 'Remover imagem destacada', 'odin' ),
		'use_featured_image'    => __( 'Usar como imagem destacada', 'odin' ),
		'insert_into_item'      => __( 'Inserir no Pin', 'odin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'odin' ),
		'items_list'            => __( 'Lista de pins', 'odin' ),
		'items_list_navigation' => __( 'Navegação da lista de pins', 'odin' ),
		'filter_items_list'     => __( 'Filtrar Pins', 'odin' ),
	);
	$args = array(
		'label'                 => __( 'Pin', 'odin' ),
		'description'           => __( 'Pins', 'odin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'revisions', 'page-attributes'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-location-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'pins', $args );

	$labels = array(
		'name'                       => _x( 'Artistas', 'Taxonomy General Name', 'odin' ),
		'singular_name'              => _x( 'Artista', 'Taxonomy Singular Name', 'odin' ),
		'menu_name'                  => __( 'Artistas', 'odin' ),
		'all_items'                  => __( 'Todos Artistas', 'odin' ),
		'parent_item'                => __( 'Artista relacionado', 'odin' ),
		'parent_item_colon'          => __( '', 'odin' ),
		'new_item_name'              => __( 'Novo nome do Artista', 'odin' ),
		'add_new_item'               => __( 'Adicionar novo Artista', 'odin' ),
		'edit_item'                  => __( 'Editar Artista', 'odin' ),
		'update_item'                => __( 'Atualizar Artista', 'odin' ),
		'view_item'                  => __( 'Ver Artista', 'odin' ),
		'separate_items_with_commas' => __( 'Separar artistas com virgulas', 'odin' ),
		'add_or_remove_items'        => __( 'Adicionar ou remover Artistas', 'odin' ),
		'choose_from_most_used'      => __( 'Escolher entre os mais populares', 'odin' ),
		'popular_items'              => __( 'Artistas mais selecionados', 'odin' ),
		'search_items'               => __( 'Buscar Artistas', 'odin' ),
		'not_found'                  => __( 'Não encontrado', 'odin' ),
		'no_terms'                   => __( 'Sem artistas', 'odin' ),
		'items_list'                 => __( 'Lista de artistas', 'odin' ),
		'items_list_navigation'      => __( '', 'odin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'artistas', array( 'pins' ), $args );
}
add_action( 'init', 'diadoagraffiti_map_custom_types', 0 );

}

