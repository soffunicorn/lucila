<?php

?>
<div class="post-content-wrapper">
    <div class="overlay"></div>
    <div class="post-image"
         style="background-image:url('<?php echo !empty(get_the_post_thumbnail_url(get_the_ID(), 'medium')) ? get_the_post_thumbnail_url(get_the_ID(), "medium") : get_stylesheet_directory() . '/assets/image/no-image-avaible.png'; ?>')">
        <div class="rutinas-content ">
            <?php
            if(get_post_type(get_the_ID()) === 'rutinas'):
                $duración = get_field('time_rutina', get_the_ID());
                if(!empty($duración)):
                    ?><p class="duration-rutina"> <?php echo $duración; ?>  min.</p><?php
                endif;
            endif;
            ?>
            <h4><a href="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
        </div>
    </div>


</div>