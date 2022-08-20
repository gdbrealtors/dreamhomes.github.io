<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-inner">

        <?php
        $content = apply_filters('the_content', get_the_content());
        $video   = false;

        // Only get video from the content if a playlist isn't present.
        if (false === strpos($content, 'wp-playlist-script')) {
            $video = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
        }
        ?>

        <?php if ('' !== get_the_post_thumbnail() && !is_single() && empty($video)) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('rehomes-featured-image-full'); ?>
                </a>
            </div><!-- .post-thumbnail -->
        <?php endif; ?>
        <div class="post-content-wrap">

            <header class="entry-header">

                <?php if ('post' === get_post_type()) : ?>
                    <div class="entry-categories">
                        <?php
                        rehomes_cat_links();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>

                <?php
                if (is_single()) {

                } elseif (is_front_page() && is_home()) {
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                } else {
                    the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
                }
                ?>

            </header><!-- .entry-header -->


            <div class="entry-content">
                <?php
                if (!is_single()) {

                    // If not a single post, highlight the video file.
                    if (!empty($video)) {
                        foreach ($video as $video_html) {
                            echo '<div class="entry-video">';
                            echo apply_filters('the_content', $video_html);
                            echo '</div>';
                        }
                    };

                }; ?>
                <?php
                if (is_single() || empty($video)) {

                    /* translators: %s: Name of current post */
                    the_content(
                        sprintf(
                            esc_html__('Read more ', 'rehomes') . '<span class="screen-reader-text"> "%s"</span>',
                            get_the_title()
                        )
                    );

                    wp_link_pages(array(
                        'before'      => '<div class="page-links">' . esc_html__('Pages:', 'rehomes'),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ));
                };
                ?>
            </div><!-- .entry-content -->

            <?php if (!is_single()){?>
                <div class="post-footer">
                    <div class="entry-meta">
                        <span class="posted-on"><i class="opal-icon-calendar"></i><?php echo rehomes_time_link(); ?></span>
                        <span class="posted-author"><i class="opal-icon-user2"></i><a
                                    href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?> "><?php echo get_the_author(); ?></a></span>
                    </div>
                </div>
            <?php }?>

            <?php
            if (is_single()) {
                rehomes_entry_footer();
            }
            ?>
        </div>
    </div>
</article><!-- #post-## -->
