<div class="column-item post-style-1">
    <div class="post-inner">

        <?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('rehomes-featured-image-large'); ?>
                </a>
            </div><!-- .post-thumbnail -->

        <?php endif; ?>
        <div class="post-content">
            <div class="entry-header">
                <div class="entry-categories">
                    <?php
                    rehomes_cat_links();
                    ?>
                </div><!-- .entry-meta -->
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="entry-meta">
                    <?php rehomes_entry_meta(); ?>
                </div>
            </div>
        </div>
    </div>
</div>