<div class="wrap">
	<?php if( $submit ) {
		 echo '<div class="updated settings-error">' . $submit . '</div>';
	}?>
	<?php screen_icon(  ); ?>
	<h2>Edit Sitemap</h2>
	<?php
		$single_select = get_option( 'single_select' );
		$single_priority = get_option( 'single_priority' );
		if( empty( $single_priority ) ) :
			$single_priority = '0.5';
		endif;
		$news_select = get_option( 'news_select' );
		$news_priority = get_option( 'news_priority' );
		if( empty( $news_priority ) ) :
			$news_priority = '0.5';
		endif;
		$gallery_select = get_option( 'gallery_select' );
		$gallery_priority = get_option( 'gallery_priority' );
		if( empty( $gallery_priority ) ) :
			$gallery_priority = '0.5';
		endif;
	?>
	<form method="post">
		<table class="form-table">
			<tr valign="top">
				<td>
					<strong>Page</strong>
				</td>
				<td>
					<strong>Change Frequency</strong>
				</td>
				<td>
					<strong>Priority</strong>
				</td>
			</tr>
			<tr>
				<td>Single Car Pages</td>
				<td>
					<select name="single_select">
						<option value="Always" <?php if( $single_select == 'Always' ) { ?> selected="selected" <?php } ?>>Always</option>
						<option value="Hourly" <?php if( $single_select == 'Hourly' ) { ?> selected="selected" <?php } ?>>Hourly</option>
						<option value="Daily" <?php if( $single_select == 'Daily' ) { ?> selected="selected" <?php } ?>>Daily</option>
						<option value="Weekly" <?php if( $single_select == 'Weekly' ) { ?> selected="selected" <?php } ?>>Weekly</option>
						<option value="Monthly" <?php if( $single_select == 'Monthly' ) { ?> selected="selected" <?php } ?>>Monthly</option>
						<option value="Yearly" <?php if( $single_select == 'Yearly' ) { ?> selected="selected" <?php } ?>>Yearly</option>
						<option value="Never" <?php if( $single_select == 'Never' ) { ?> selected="selected" <?php } ?>>Never</option>
					</select>
				</td>
				<td><input type="text" name="single_priority" value="<?php echo $single_priority; ?>" />
			</tr>
			<tr>
				<td>Single News Pages</td>
				<td>
					<select name="news_select">
						<option value="Always" <?php if( $news_select == 'Always' ) { ?> selected="selected" <?php } ?>>Always</option>
						<option value="Hourly" <?php if( $news_select == 'Hourly' ) { ?> selected="selected" <?php } ?>>Hourly</option>
						<option value="Daily" <?php if( $news_select == 'Daily' ) { ?> selected="selected" <?php } ?>>Daily</option>
						<option value="Weekly" <?php if( $news_select == 'Weekly' ) { ?> selected="selected" <?php } ?>>Weekly</option>
						<option value="Monthly" <?php if( $news_select == 'Monthly' ) { ?> selected="selected" <?php } ?>>Monthly</option>
						<option value="Yearly" <?php if( $news_select == 'Yearly' ) { ?> selected="selected" <?php } ?>>Yearly</option>
						<option value="Never" <?php if( $news_select == 'Never' ) { ?> selected="selected" <?php } ?>>Never</option>
					</select>
				</td>
				<td><input type="text" name="news_priority" value="<?php echo $news_priority; ?>" />
			</tr>
			<tr>
				<td>Single Gallery Pages</td>
				<td>
					<select name="gallery_select">
						<option value="Always" <?php if( $gallery_select == 'Always' ) { ?> selected="selected" <?php } ?>>Always</option>
						<option value="Hourly" <?php if( $gallery_select == 'Hourly' ) { ?> selected="selected" <?php } ?>>Hourly</option>
						<option value="Daily" <?php if( $gallery_select == 'Daily' ) { ?> selected="selected" <?php } ?>>Daily</option>
						<option value="Weekly" <?php if( $gallery_select == 'Weekly' ) { ?> selected="selected" <?php } ?>>Weekly</option>
						<option value="Monthly" <?php if( $gallery_select == 'Monthly' ) { ?> selected="selected" <?php } ?>>Monthly</option>
						<option value="Yearly" <?php if( $gallery_select == 'Yearly' ) { ?> selected="selected" <?php } ?>>Yearly</option>
						<option value="Never" <?php if( $gallery_select == 'Never' ) { ?> selected="selected" <?php } ?>>Never</option>
					</select>
				</td>
				<td><input type="text" name="gallery_priority" value="<?php echo $gallery_priority; ?>" />
			</tr>
			<?php foreach( $pages as $page ) : ?>
				<?php
					$select = get_post_meta( $page->ID, 'select', true );
					$priority = get_post_meta( $page->ID, 'priority', true );
					if( empty( $priority ) ) :
						$priority = '0.5';
					endif;
				?>
			<tr>
				<td><?php echo get_permalink( $page->ID ); ?></td>
				<td>
					<select name="<?php echo $page->ID; ?>_select">
						<option value="Always" <?php if( $select == 'Always' ) { ?> selected="selected" <?php } ?>>Always</option>
						<option value="Hourly" <?php if( $select == 'Hourly' ) { ?> selected="selected" <?php } ?>>Hourly</option>
						<option value="Daily" <?php if( $select == 'Daily' ) { ?> selected="selected" <?php } ?>>Daily</option>
						<option value="Weekly" <?php if( $select == 'Weekly' ) { ?> selected="selected" <?php } ?>>Weekly</option>
						<option value="Monthly" <?php if( $select == 'Monthly' ) { ?> selected="selected" <?php } ?>>Monthly</option>
						<option value="Yearly" <?php if( $select == 'Yearly' ) { ?> selected="selected" <?php } ?>>Yearly</option>
						<option value="Never" <?php if( $select == 'Never' ) { ?> selected="selected" <?php } ?>>Never</option>
					</select>
				</td>
				<td><input type="text" name="<?php echo $page->ID; ?>_priority" value="<?php echo $priority; ?>" />
			</tr>
		<?php endforeach; ?>
			<tr>
				<td colspan="3">
					<?php submit_button(  ); ?>
				</td>
			</tr>
		</table>
	</form>
</div>