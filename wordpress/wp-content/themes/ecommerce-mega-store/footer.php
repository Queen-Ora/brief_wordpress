<footer>
 <div class="container">
      <?php
        if (is_active_sidebar('ecommerce-mega-store-footer-sidebar')) {
          echo '<div class="row sidebar-area footer-area">';
            dynamic_sidebar('ecommerce-mega-store-footer-sidebar');
          echo '</div>';
        } else { ?>
          <div id="footer-widgets" role="contentinfo">
            <div class="container">
              <div class="row sidebar-area footer-area">
                <div id="categories-2" class="col-lg-3 col-md-6 widget_categories">
                    <h4 class="title"><?php esc_html_e('Categories', 'ecommerce-mega-store'); ?></h4>
                    <ul>
                        <?php
                        wp_list_categories(array(
                            'title_li' => '',
                        ));
                        ?>
                    </ul>
                </div>
                <div id="pages-2" class="col-lg-3 col-md-6 widget_pages">
                    <h4 class="title"><?php esc_html_e('Pages', 'ecommerce-mega-store'); ?></h4>
                    <ul>
                        <?php
                        wp_list_pages(array(
                            'title_li' => '',
                        ));
                        ?>
                    </ul>
                </div>
                <div id="archives-2" class="col-lg-3 col-md-6 widget_archive">
                    <h4 class="title"><?php esc_html_e('Archives', 'ecommerce-mega-store'); ?></h4>
                    <ul>
                        <?php
                        wp_get_archives(array(
                            'type' => 'postbypost',
                            'format' => 'html',
                            'before' => '<li>',
                            'after' => '</li>',
                        ));
                        ?>
                    </ul>
                </div>
                <div id="calendar" class="col-lg-3 col-md-6 widget_calendar">
                  <h4 class="title"><?php esc_html_e('Calendar', 'ecommerce-mega-store'); ?></h4>
                  <?php get_calendar(); ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
    </div>
  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copy-text">
          <p class="mb-0 py-3">
            <?php
              if (!get_theme_mod('ecommerce_mega_store_footer_text') ) { ?>
                <a href="<?php echo esc_url(__('https://www.misbahwp.com/products/free-ecommerce-wordpress-theme', 'ecommerce-mega-store' )); ?>" target="_blank">
                <?php esc_html_e('Ecommerce WordPress Theme ','ecommerce-mega-store'); ?></a>
              <?php } else {
                echo esc_html(get_theme_mod('ecommerce_mega_store_footer_text'));
              }
            ?>
            <?php if ( get_theme_mod('ecommerce_mega_store_copyright_enable', true) == true ) : ?>
              <?php
              /* translators: %s: Misbah WP */
              printf( esc_html__( 'by %s', 'ecommerce-mega-store' ), 'Misbah WP' ); ?>
              <a href="<?php echo esc_url(__('https://wordpress.org', 'ecommerce-mega-store' )); ?>" rel="generator"><?php  /* translators: %s: WordPress */  printf( esc_html__( ' | Proudly powered by %s', 'ecommerce-mega-store' ), 'WordPress' ); ?></a>
            <?php endif; ?>
          </p>
        </div>
        </div>
      </div>
    </div>
  </div>
    <?php if ( get_theme_mod('ecommerce_mega_store_scroll_enable_setting', true) == true ) : ?>
      <div class="scroll-up">
        <a href="#tobottom"><i class="fa fa-arrow-up"></i></a>
      </div>
    <?php endif; ?>

</footer>

<?php wp_footer(); ?>

</body>
</html>
