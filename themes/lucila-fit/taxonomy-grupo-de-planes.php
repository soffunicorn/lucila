<?php
get_header();
$term = get_queried_object();
$duracion = get_field('duration_planes', $term);
$intensidad = get_field('intensidad_group_plan', $term);
$nivel = get_field('nivel_group_plan', $term);

?>
    <section id="main-content">
    <div class="background-single-wrapper">
        <div class="overlay"></div>
        <div class="image-background-image" <?php echo !empty(get_the_post_thumbnail_url()) ? "style='background-image:url(" . get_the_post_thumbnail_url() . ") '" : ""; ?>>
            <div class="inner-bg-cover">
                <?php get_template_part('template-parts/content/video-logic') ?>
                <div class="inner-bg-content">
                    <h1><?php echo $term->name; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="planes-content">
        <div class="container-fluid">
            <ul class="rutina-data">
                <?php if(!empty($intensidad)) : ?>
                <li><p><?php echo __('Intensidad', 'lucila-fit') . "<br>" .$intensidad ; ?></p></li>
                <?php endif; ?>
                 <?php if(!empty($duracion)) : ?>
                <li><p><?php echo  $duracion. "<br> Semanas"; ?></p></li>
                 <?php endif; ?>
                   <?php if(!empty($nivel)) : ?>
                <li><p><?php echo __('Nivel', 'lucila-fit') . "<br>" . $nivel; ?></p></li>
                   <?php endif; ?>
            </ul>
            <?php if(!empty($term->description)): ?>
            <p class="rutinas-description"><?php  echo $term->description; ?></p>
            <?php endif; ?>
            <?php
            $args = array(
                'posts_per_page' => '5',
                'post_type' => 'planes',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'grupo-de-planes',
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    )
                )
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $video = get_field('video_plan', get_the_ID());
                    $is_view =  false;
                    $is_ended = false;
                    ?>
                    <div class="video-planes-tax" id="videoContent">
                        <div class="complete-rutine">
                            <?php
                            if (is_user_logged_in()) {
                                $user_view = get_user_meta(get_current_user_id(), 'user_start_video', false);
                                $user_end_video = get_post_meta(get_current_user_id(), 'user_ended_video', false);
                            }

                              if (!empty($user_view) && empty($user_end_video)) :
                                if (in_array(get_the_ID(), $user_view[0])) :
                                    $is_view = true;
                                endif;
                            endif;

                            if (!empty($user_end_video)) :
                                if ( in_array(get_the_ID(), $user_end_video) ) :
                                    $is_ended = true;
                                endif;
                            endif;
                            ?>
                            <div class="start-rutine <?php echo $is_view ? 'visible' :'hidden';  ?>">
                                <p><?php echo __('Rutina Empezada', 'lucila-fit'); ?></p>
                                <span class="round-icon"><i class="fas fa-check"></i></span>
                            </div>


                            <div class="ended-video <?php echo $is_ended ? 'visible' :'hidden';  ?>">
                                <p><?php echo __('Rutina Completa', 'lucila-fit'); ?></p>
                                <span class="round-icon"><i class="fas fa-check"></i></span>
                            </div>

                        </div>
                        <video controls width="100%" class="video-rutinas" data-postid="<?php the_ID(); ?>"
                               data-userid="<?php echo get_current_user_id(); ?>"
                               placeholder="<?php echo !empty(get_the_post_thumbnail_url()) ? the_post_thumbnail_url() : ""; ?>" data-count="0">
                            <source src="<?php echo $video['url']; ?>" type="<?php echo $video['mime_type'] ?>"/>
                        </video>
                    </div>
                    <?php

                }
            }
            ?>
        </div>
    </div>
    <div class="post-related">
        <h2>  <?php echo __('Recetas para acompañar tu plan', 'lucila-fit') ?></h2>
        <?php
        $args = array(
            'post_type' => array('post'),
            'orderby' => 'DATE',
            'order' => 'DESC',
            'post_status' => 'publish',
            'posts_per_page ' => '5'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {

            ?>
            <div class="post-related-wrapper">
                <div class="container-fluid">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/content/post-loop');
                    } ?>

                </div>
            </div>
            <?php
        }
        ?>

    </div>


<?php

get_footer();