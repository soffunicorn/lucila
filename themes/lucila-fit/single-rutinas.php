<?php
get_header();
$video = get_field('video_rutina', get_the_ID());
$featured_image = get_the_post_thumbnail_url();
$intensidad = get_field('intensidad_rutina', get_the_ID());
$nivel = get_field('nivel_rutina', get_the_ID());

?>
    <section id="main-content">
        <div class="background-single-wrapper">
            <div class="overlay"></div>
            <div class="image-background-image" <?php echo !empty(get_the_post_thumbnail_url()) ? "style='background-image:url(" . get_the_post_thumbnail_url() . ") '" : ""; ?>>
                <div class="inner-bg-cover">
                    <?php get_template_part('template-parts/content/video-logic') ?>
                    <div class="inner-bg-content">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="rutinas-content">
            <div class="container">
                <ul class="rutina-data">
                    <li><p><?php echo __('Intensidad', 'lucila-fit') . "<br> " . $intensidad ?></p></li>
                    <li><p><?php echo __('Nivel', 'lucila-fit') . "<br> " . $nivel ?></p></li>
                </ul>
                <p class="rutinas-description"><?php echo get_the_content(); ?></p>

                <?php if (!empty($video)) :
                    ?>
                    <video controls width="100%" class="video-rutinas"
                           placeholder="<?php echo !empty(get_the_post_thumbnail_url()) ? the_post_thumbnail_url() : ""; ?>">
                        <source src="<?php echo $video['url']; ?>" type="<?php echo $video['mime_type'] ?>"/>
                    </video>
                <?php endif; ?>
            </div>
        </div>
        <div class="post-related">
            <h2>  <?php echo __('Rutinas Similares', 'lucila-fit') ?></h2>
            <?php
            $args = array(
                'post_type' => array('rutinas'),
                'post__not_in' => array(get_the_ID()),
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
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

    </section>
<?php
get_footer();