<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' );
			?>

			<!-- Add Bulletin Board custom posts -->
            <div id="announcement_box"  class="ption_a">
             <div id="announcement">
               <ul style="color:#515151; list-style: circle outside none; margin:0; padding: 0; text-align: center;">
                <?php
                  $loop = new WP_Query( array( 'post_type' => 'bulletin', 'posts_per_page' => 2 ) );
                  while ( $loop->have_posts() ) : $loop->the_post();
                ?>
                <li style="margin: 0 10px; display: inline;"><span class="mr10">
                </span><a style="text-decoration: none;" href="<?php echo the_permalink() ?>"  title="<?php the_title(); ?>"  ><?php the_title(); ?></a></li>
                <?php endwhile; wp_reset_query(); ?>
               </ul>
             </div>
			</div>			
			
		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

