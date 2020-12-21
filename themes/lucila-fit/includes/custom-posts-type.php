<?php

    $labels = array(
        'name'               => _x( 'Rutinas', 'post type general name', 'lucila-fit' ),
        'singular_name'      => _x( 'Rutina', 'post type singular name', 'lucila-fit' ),
        'menu_name'          => _x( 'Rutinas', 'admin menu', 'lucila-fit' ),
        'name_admin_bar'     => _x( 'Rutina', 'add new on admin bar', 'lucila-fit' ),
        'add_new'            => _x( 'Agregar Nueva', 'Asociación de Pacientes', 'lucila-fit' ),
        'add_new_item'       => __( 'Agregar Nueva', 'lucila-fit' ),
        'new_item'           => __( 'Nuevo Rutina', 'lucila-fit' ),
        'edit_item'          => __( 'Editar', 'lucila-fit' ),
        'view_item'          => __( 'Ver Rutina', 'lucila-fit' ),
        'all_items'          => __( 'Todos las Rutinas', 'lucila-fit' ),
        'search_items'       => __( 'Buscar Rutinas', 'lucila-fit' ),
        'not_found'          => __( 'No se han encontrado Rutinas.', 'lucila-fit' ),
        'not_found_in_trash' => __( 'No se han encontrado Rutinas', 'lucila-fit' )
    );

$args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-universal-access',
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'rutinas'),
    'capability_type'     => 'post',
    'has_archive'         => false,
    'hierarchical'        => false,
//'menu_position'       => 5,
    'supports'            => array( 'title', 'editor', 'thumbnail','custom-fields', 'page-attributes'),
);

register_post_type( 'rutinas', $args );


$labels_planes = array(
    'name' => _x('Planes', 'post type general name', 'lucila-fit'),
    'singular_name' => _x('Plan', 'post type singular name', 'lucila-fit'),
    'menu_name' => _x('Planes', 'admin menu', 'lucila-fit'),
    'name_admin_bar' => _x('Planes', 'add new on admin bar', 'lucila-fit'),
    'add_new' => _x('Agregar Nuevo', 'Asociación de Pacientes', 'lucila-fit'),
    'add_new_item' => __('Agregar Nuevo', 'lucila-fit'),
    'new_item' => __('Nuevo Plan', 'lucila-fit'),
    'edit_item' => __('Editar', 'lucila-fit'),
    'view_item' => __('Ver Plan', 'lucila-fit'),
    'all_items' => __('Todos los Planes', 'lucila-fit'),
    'search_items' => __('Buscar Planes', 'lucila-fit'),
    'not_found' => __('No se han encontrado Planes', 'lucila-fit'),
    'not_found_in_trash' => __('No se han encontrado Planes', 'lucila-fit')
);

$args_planes = array(
    'labels' => $labels_planes,
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-edit-page',
    'query_var' => true,
    'rewrite' => array('slug' => 'planes'),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
//'menu_position'       => 5,
    'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
);

register_post_type('planes', $args_planes);