<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-inner">
        <div class="post-content-wrap">
            <header class="entry-header">
                <?php
                if (is_front_page() && !is_home()) {

                    // The excerpt is being displayed within a front page section, so it's a lower hierarchy than h2.
                    the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                } else {
                    the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
                }
                ?>
                <?php if (!is_single()){?>
                    <div class="entry-meta">
                        <?php
                        rehomes_entry_meta();
                        ?>
                    </div>
                <?php }?>
            </header><!-- .entry-header -->

            <div class="entry-summary">
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </div><!-- .entry-summary -->

        </div>
    </div>
</article><!-- #post-## -->
