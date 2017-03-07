<?php
/**
 * Template Name: Contacts Page
 *
 * @since Malteser 1.0
 */
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<?php
			get_template_part( 'template-parts/content', 'breadcrumbs' );
		?>
		<section class="page__entry">
		<?php
			if ( have_posts() ) :  while ( have_posts() ) : the_post();
		?>
			<h1 class="g-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php
			endwhile;
			endif;
		?>
			<div class="b-contacts" itemscope="" itemtype="http://schema.org/Organization">
			<?php
				$city = "Київ";
				$country = "Україна";
				$address_name = "Адреса:";
				$street_address="вул. Січневого Повстання, 17а кв.19";
				$phone = "Телефон:";
				
				if ( pll_current_language() != 'uk' ){ 
					$city = "Kijów";
					$country = "Ukraina";
					$address_name = "Adres:";
					$street_address="st. Powstania Styczniowego, 17a 19";
					$phone = "Telefon:";
				}
			?>
				<meta itemprop="name" content="<?php pll_e( 'Logo text' ); ?>, <?php echo $country; ?>, <?php echo $city; ?>" />
				<meta itemprop="description" content="<?php pll_e( 'Logo Description' ); ?>" />
				<div class="g-row">
					<div class="g-col g-col--one-third" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
						<span class="b-contacts__title">
							<i class="icon-location"></i>
							<?php echo $address_name; ?>
						</span>
						<p>
							<b>Юридична адреса:</b>
							<br />
							<span itemprop="postalCode">03148</span>,
							<span itemprop="addressLocality"><?php echo $city; ?></span>,
							<span itemprop="streetAddress">
								<?php echo $street_address; ?>
							</span>
							<meta itemprop="addressCountry" content="<?php echo $country; ?>" />
						</p>
						<p>
							<b>Офіс:</b>
							<br />
							03167, Київ, вул.Виборзька 89
							<br />
							(станція швидкої допомоги №14)
						</p>
					</div>
					<div class="g-col g-col--one-third">
						<span class="b-contacts__title">
							<i class="icon-phone"></i>
							<?php echo $phone; ?>
						</span>
						<p>
							<span itemprop="telephone">+380 44 227-37-28</span>
							<br />
							+380 96 699-99-11
						</p>
					</div>
					<div class="g-col g-col--one-third">
						<span class="b-contacts__title">
							<i class="icon-mail"></i>
							Email:
						</span>
						<p>
							<a href="mailto:malteser.kyiv@gmail.com">
								<span itemprop="email">malteser.kyiv@gmail.com</span>
							</a>
						</p>
					</div>
				</div><!--/g-row-->
			</div><!--/.b-contacts-->
		</section>
    </div>
</div>

<section class="page__section page-section--alt">
	<div class="g-container">
		<h2 class="g-subtitle g-text-center">
			<?php pll_e( 'Any questions?' ); ?>
		</h2>
		<?php get_template_part( 'template-parts/form', 'contacts' ); ?>
	</div>
</section>

<div class="g-map" id="map"></div>
<?php
    get_footer();
?>
