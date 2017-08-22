<?php
if ( ! function_exists('diadoagraffiti_map_custom_types') ) {

// Register Custom Post Type
function diadoagraffiti_map_custom_types() {

	$labels = array(
		'name'                  => _x( 'Pontos', 'Post Type General Name', 'odin' ),
		'singular_name'         => _x( 'Ponto', 'Post Type Singular Name', 'odin' ),
		'menu_name'             => __( 'Pontos', 'odin' ),
		'name_admin_bar'        => __( 'Pontos', 'odin' ),
		'archives'              => __( 'Pontos', 'odin' ),
		'parent_item_colon'     => __( 'Ponto relacionado', 'odin' ),
		'all_items'             => __( 'Todos Pontos', 'odin' ),
		'add_new_item'          => __( 'Adicionar novo Ponto', 'odin' ),
		'add_new'               => __( 'Adicionar novo', 'odin' ),
		'new_item'              => __( 'Novo Ponto', 'odin' ),
		'edit_item'             => __( 'Editar Ponto', 'odin' ),
		'update_item'           => __( 'Atualizar Ponto', 'odin' ),
		'view_item'             => __( 'Ver Ponto', 'odin' ),
		'search_items'          => __( 'Buscar Ponto', 'odin' ),
		'not_found'             => __( 'Não encontrado', 'odin' ),
		'not_found_in_trash'    => __( 'Não encontrado na lixeira', 'odin' ),
		'featured_image'        => __( 'Imagem destacada', 'odin' ),
		'set_featured_image'    => __( 'Setar imagem destacada', 'odin' ),
		'remove_featured_image' => __( 'Remover imagem destacada', 'odin' ),
		'use_featured_image'    => __( 'Usar como imagem destacada', 'odin' ),
		'insert_into_item'      => __( 'Inserir no Ponto', 'odin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'odin' ),
		'items_list'            => __( 'Lista de pontos', 'odin' ),
		'items_list_navigation' => __( 'Navegação da lista de pontos', 'odin' ),
		'filter_items_list'     => __( 'Filtrar Pontos', 'odin' ),
	);
	$args = array(
		'label'                 => __( 'Ponto', 'odin' ),
		'description'           => __( 'Pontos', 'odin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail'),
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
		'name'                       => _x( 'Categorias', 'Taxonomy General Name', 'odin' ),
		'singular_name'              => _x( 'Categoria', 'Taxonomy Singular Name', 'odin' ),
		'menu_name'                  => __( 'Categorias', 'odin' ),
		'all_items'                  => __( 'Todos Categorias', 'odin' ),
		'parent_item'                => __( 'Categoria relacionado', 'odin' ),
		'parent_item_colon'          => __( '', 'odin' ),
		'new_item_name'              => __( 'Novo nome do Categoria', 'odin' ),
		'add_new_item'               => __( 'Adicionar novo Categoria', 'odin' ),
		'edit_item'                  => __( 'Editar Categoria', 'odin' ),
		'update_item'                => __( 'Atualizar Categoria', 'odin' ),
		'view_item'                  => __( 'Ver Categoria', 'odin' ),
		'separate_items_with_commas' => __( 'Separar Categorias com virgulas', 'odin' ),
		'add_or_remove_items'        => __( 'Adicionar ou remover Categorias', 'odin' ),
		'choose_from_most_used'      => __( 'Escolher entre os mais populares', 'odin' ),
		'popular_items'              => __( 'Categorias mais selecionados', 'odin' ),
		'search_items'               => __( 'Buscar Categorias', 'odin' ),
		'not_found'                  => __( 'Não encontrado', 'odin' ),
		'no_terms'                   => __( 'Sem Categorias', 'odin' ),
		'items_list'                 => __( 'Lista de Categorias', 'odin' ),
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
	register_taxonomy( 'tipo', array( 'pins' ), $args );
}
add_action( 'init', 'diadoagraffiti_map_custom_types', 0 );

}
