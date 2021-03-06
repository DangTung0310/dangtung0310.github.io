<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $post;
global $more;
$more = false;

$wrapper_attributes = array();
$wrapper_attributes[] = 'id="eut-tribe-events-list"';
$wrapper_attributes[] = 'class="eut-tribe-events-loop eut-blog eut-blog-small eut-non-isotope"';
$event_item_class_string = 'eut-blog-item eut-non-isotope-item eut-small-post';
?>

<div <?php echo implode( ' ', $wrapper_attributes ); ?>>

	<div class="eut-standard-container">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<!-- Month / Year Headers -->
		<?php tribe_events_list_the_date_headers(); ?>

		<!-- Event  -->
		<?php
		$post_parent = '';
		if ( $post->post_parent ) {
			$post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
		}
		?>
		<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes(); ?> <?php echo esc_attr( $event_item_class_string ); ?>" <?php echo !empty( $post_parent ) ? $post_parent : ''; ?>>
			<?php
			$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

			/**
			 * Filters the event type used when selecting a template to render
			 *
			 * @param $event_type
			 */
			$event_type = apply_filters( 'tribe_events_list_view_event_type', $event_type );

			tribe_get_template_part( 'list/single', $event_type );
			?>
		</div>


		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>

	</div>

</div><!-- .tribe-events-loop -->