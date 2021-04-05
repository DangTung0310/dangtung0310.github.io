<form class="eut-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<button type="submit" class="eut-search-btn eut-custom-btn" aria-label="<?php esc_attr_e( 'Search', 'crocal' ); ?>"><i class="eut-icon-search"></i></button>
	<input type="text" class="eut-search-textfield" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr__( 'Search for ...', 'crocal' ); ?>" aria-label="<?php echo esc_attr__( 'Search for ...', 'crocal' ); ?>"/>
</form>