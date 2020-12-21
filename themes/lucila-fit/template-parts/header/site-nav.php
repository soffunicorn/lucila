<?php
/**
 * Displays the site navigation.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since 1.0.0
 */

?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
    <nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'twentytwentyone' ); ?>">
        <div class="menu-button-container">
            <button id="primary-mobile-menu" class="button" aria-controls="primary-menu-list" aria-expanded="false">
				<span class="dropdown-icon open">
                    <?php echo twenty_twenty_one_get_icon_svg( 'ui', 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</span>
                <span class="dropdown-icon close">
                    <?php echo twenty_twenty_one_get_icon_svg( 'ui', 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</span>
            </button><!-- #primary-mobile-menu -->
        </div><!-- .menu-button-container -->
      <div class="primary-menu-container">
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'menu_class'      => 'menu-wrapper',
                'container_class' => '',
                'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
                'fallback_cb'     => false,
            )
        );
        ?>
          <div class="search-menu">
              <form action="" name="form-search" id="formSearch">
                  <input type="search"  name="s" value="<?php echo get_search_query(); ?>" placeholder="Búscar aquí"/>
                  <button type="button" id="butonSearch" class="search-button"><i class="fas fa-search"></i></button>
              </form>
          </div>

       <div class="icons-menu">
           <!-- @TODO colocar menu dimanico con acf y fontawesome -->
           <?php
           wp_nav_menu(
               array(
                   'menu'  => 'nav icons',
                   'menu_class'      => 'nav-menu-icons',
                   'container_class' => '',
                   'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
                   'fallback_cb'     => false,
               )
           );
           ?>
</div>
</div>
</nav><!-- #site-navigation -->
<?php endif; ?>
<?php
