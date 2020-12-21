<?php
get_header();
?>
    <div class="homeContent">

        <ul class="nav nav-tabs" id="tabHome" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="rutinas-tab" data-toggle="tab" href="#rutinas" role="tab"
                   aria-controls="home" aria-selected="true"><?php echo __('Rutinas', 'lucila-fit') ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="recetas-tab" data-toggle="tab" href="#recetas" role="tab"
                   aria-controls="profile" aria-selected="false"><?php echo __('Recetas', 'lucila-fit') ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="planes-tab" data-toggle="tab" href="#planes" role="tab" aria-controls="contact"
                   aria-selected="false"><?php echo __('Planes', 'lucila-fit') ?></a>
            </li>
        </ul>


        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="rutinas" role="tabpanel" aria-labelledby="rutinas-tab">
                <div class="container-fluid">
                    <?php
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => array('rutinas'),
                        'posts_per_page' => '10',
                        'orderby' => 'DATE',
                        'order' => 'DESC',
                    );
                    $rutinas_query = new WP_Query($args);
                    if ($rutinas_query->have_posts()):
                        while ($rutinas_query->have_posts()):
                            $rutinas_query->the_post();
                            get_template_part('template-parts/content/post-loop');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                    <button type="button" class="btn btn-loadmore" id="loadMore">Ver más</button>
                </div>
            </div>

            <div class="tab-pane fade" id="recetas" role="tabpanel" aria-labelledby="recetas-tab">
              <div class="container-fluid">
                <?php
                $args_recetas = array(
                    'post_status' => 'publish',
                    'post_type' => array('post'),
                    'posts_per_page' => '10',
                    'orderby' => 'DATE',
                    'order' => 'DESC',
                );
                $recetas_query = new WP_Query($args_recetas);
                if ($recetas_query->have_posts()):
                    while ($recetas_query->have_posts()):
                        $recetas_query->the_post();
                        get_template_part('template-parts/content/post-loop');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                <button type="button" class="btn btn-loadmore" id="loadMore">Ver más</button>
              </div>
            </div>
            <div class="tab-pane fade" id="planes" role="tabpanel" aria-labelledby="planes-tab">
                <div class="container-fluid">
                    <?php
                    $args_planes = array(
                        'taxonomy' => 'grupo-de-planes',
                        'number' => '10',
                        'orderby' => 'name',
                        'order' => 'ASC',
                    );
                    $planes_terms = get_terms($args_planes);
                    if (!empty($planes_terms)):
                        foreach ($planes_terms as $term):
                            $term_image = get_field('image_group_plan', $term );
                            ?>
                            <div class="post-content-wrapper wow bounceInUp">
                                <div class="overlay">  </div>
                                    <a href="<?php echo get_term_link($term->term_id); ?>">
                                        <div class="post-image"
                                             style="background-image:url('<?php echo !empty($term_image) ? $term_image['url'] :get_stylesheet_directory() . '/assets/image/no-image-avaible.png'; ?>')">
                                            <div class="rutinas-content">
                                                <h4><?php echo $term->name; ?></h4>
                                            </div>
                                        </div>
                                    </a>

                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
<?php

get_footer();