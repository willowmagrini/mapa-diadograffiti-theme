<?php
/* ACF Custom Fields */

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
