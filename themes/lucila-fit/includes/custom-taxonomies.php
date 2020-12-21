<?php
$tax_labels = array(
    'name'                       => _x( 'Grupo de Planes', 'taxonomy general name', 'lucila-fit' ),
    'singular_name'              => _x( 'Grupo de Plan', 'taxonomy singular name', 'lucila-fit' ),
    'search_items'               => __( 'Buscar Plan', 'lucila-fit' ),
    'popular_items'              => __( 'Mejores Planes', 'lucila-fit' ),
    'all_items'                  => __( 'Todas los Planes Destacados'),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Editar Grupo', 'lucila-fit' ),
    'update_item'                => __( 'Actualizar Grupo', 'lucila-fit' ),
    'add_new_item'               => __( 'Agregar Grupo', 'lucila-fit' ),
    'new_item_name'              => __( 'Nuevo Nombre de Grupo', 'lucila-fit' ),
    'separate_items_with_commas' => __( 'Separar Grupo con coma', 'lucila-fit' ),
    'add_or_remove_items'        => __( 'Agregar o eliminar Grupo', 'lucila-fit' ),
    'choose_from_most_used'      => __( 'Elegir por el Grupo más usado', 'lucila-fit' ),
    'not_found'                  => __( 'No se han Grupo.', 'lucila-fit' ),
    'menu_name'                  => __( 'Grupo de Planes', 'lucila-fit' ),
);

$args = array(
    'hierarchical'          => true,
    'labels'                => $tax_labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'grupo-de-planes' ),
);

register_taxonomy( 'grupo-de-planes', array('planes'), $args );