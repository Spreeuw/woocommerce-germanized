<?php
/**
 * The Template for displaying DHL preferred services within checkout.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce-germanized/checkout/dhl/preferred-services.php.
 *
 * HOWEVER, on occasion Germanized will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://github.com/vendidero/woocommerce-germanized/wiki/Overriding-Germanized-Templates
 * @package Germanized/DHL/Templates
 * @version 1.0.0
 */
defined( 'ABSPATH' ) || exit;
?>

<tr class="dhl-preferred-service">
	<td colspan="2" class="dhl-preferred-service-content">
        <div class="dhl-preferred-service-item dhl-preferred-service-header">
            <div class="dhl-preferred-service-logo">
                <img src="<?php echo $logo_url; ?>" alt="DHL logo" class="dhl-co-logo">
            </div>
            <div class="dhl-preferred-service-title">
		        <?php _ex('DHL Preferred Delivery. Delivered just as you wish.', 'dhl', 'woocommerce-germanized' ); ?>
            </div>
            <div class="dhl-preferred-service-desc">
		        <?php _ex('Thanks to the ﬂexible recipient services of DHL Preferred Delivery, you decide
when and where you want to receive your parcels.<br/>
Please choose your preferred delivery option.', 'dhl', 'woocommerce-germanized' ); ?>
            </div>
        </div>

		<?php if ( ! empty( $preferred_day_time_options ) && isset( $preferred_day_time_options['preferred_day'] ) && ! empty( $preferred_day_time_options['preferred_day'] ) && $preferred_day_enabled ) : ?>
            <div class="dhl-preferred-service-item dhl-preferred-service-day">
                <div class="dhl-preferred-service-title"><?php _ex( 'Preferred day: Delivery at your preferred day.', 'dhl', 'woocommerce-germanized' ); ?> <?php echo wc_help_tip( _x( 'Choose one of the displayed days as your preferred day for your parcel delivery. Other days are not possible due to delivery processes.', 'dhl', 'woocommerce-germanized' ) ); ?></div>

                <?php if ( ! empty( $preferred_day_cost ) ) : ?>
                    <div class="dhl-preferred-service-cost">
                        <?php printf( _x( 'There is a surcharge of %s incl. VAT for this service.*', 'dhl', 'woocommerce-germanized' ), wc_price( $preferred_day_cost ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="dhl-preferred-service-data">
                    <ul class="dhl-preferred-service-times dhl-preferred-service-days">
		                <?php foreach( $preferred_day_time_options['preferred_day'] as $key => $value ) :
                            $key          = empty( $key ) ? '' : $key;
			                $week_day_num = empty( $key ) ? '-' : date('j', strtotime( $key ) );
			                $is_selected  = $preferred_day === $key ? 'checked="checked"' : '';
			                ?>
                            <li>
                                <input type="radio" name="dhl_preferred_day" class="dhl-preferred-day-option" id="dhl-preferred-day-<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( empty( $key ) ? '' : date('Y-m-d', strtotime( $key ) ) ); ?>" <?php echo $is_selected; ?> />
                                <label for="dhl-preferred-day-<?php echo $key; ?>"><span class="dhl-preferred-time-title"><?php echo $week_day_num; ?></span><span class="dhl-preferred-time-value"><?php echo $value; ?></span></label>
                            </li>
		                <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

		<?php if ( ! empty( $preferred_day_time_options ) && isset( $preferred_day_time_options['preferred_time'] ) && ! empty( $preferred_day_time_options['preferred_time'] ) && $preferred_time_enabled ) : ?>
            <div class="dhl-preferred-service-item dhl-preferred-service-time">
                <div class="dhl-preferred-service-title"><?php _ex( 'Preferred time: Delivery during your preferred time slot.', 'dhl', 'woocommerce-germanized' ); ?> <?php echo wc_help_tip( _x( 'Indicate a preferred time, which suits you best for your parcel delivery by choosing one of the displayed time windows.', 'dhl', 'woocommerce-germanized' ) ); ?></div>

				<?php if ( ! empty( $preferred_time_cost ) ) : ?>
                    <div class="dhl-preferred-service-cost">
						<?php printf( _x( 'There is a surcharge of %s incl. VAT for this service.*', 'dhl', 'woocommerce-germanized' ), wc_price( $preferred_time_cost ) ); ?>
                    </div>
				<?php endif; ?>

                <div class="dhl-preferred-service-data">
                    <ul class="dhl-preferred-service-times dhl-preferred-service-time">
						<?php foreach( $preferred_day_time_options['preferred_time'] as $key => $value ) :
							$key          = empty( $key ) ? '' : $key;
							$is_selected  = $preferred_time === $key ? 'checked="checked"' : '';
							?>
                            <li>
                                <input type="radio" name="dhl_preferred_time" class="dhl-preferred-time-option" id="dhl-preferred-time-<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php echo $is_selected; ?> />
                                <label for="dhl-preferred-time-<?php echo $key; ?>"><span class="dhl-preferred-time-title"><?php echo ( empty( $key ) ? _x( 'None', 'dhl time context', 'woocommerce-germanized' ) : $key ); ?></span></label>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </div>
            </div>
		<?php endif; ?>

		<?php if ( $preferred_location_enabled || $preferred_neighbor_enabled ) : ?>
            <div class="dhl-preferred-service-item dhl-preferred-service-location">
                <div class="dhl-preferred-service-title"><?php _ex( 'Preferred location or neighbor', 'dhl', 'woocommerce-germanized' ); ?> <?php echo wc_help_tip( _x( 'Indicate a preferred time, which suits you best for your parcel delivery by choosing one of the displayed time windows.', 'dhl', 'woocommerce-germanized' ) ); ?></div>

                <div class="dhl-preferred-service-data">
                    <ul class="dhl-preferred-location-types">
                        <li>
                            <input type="radio" name="dhl_preferred_location_type" id="dhl-preferred_location-none" class="" value="none" <?php checked( 'none', $preferred_location_type ); ?> />
                            <label for="dhl-preferred_location-none"><?php _ex( 'None', 'dhl location context', 'woocommerce-germanized' ); ?></label>
                        </li>
                        <?php if ( $preferred_location_enabled ) : ?>
                            <li>
                                <input type="radio" name="dhl_preferred_location_type" id="dhl-preferred_location-place" class="" value="place" <?php checked( 'place', $preferred_location_type ); ?> />
                                <label for="dhl-preferred_location-place"><?php _ex( 'Location', 'dhl', 'woocommerce-germanized' ); ?></label>
                            </li>
                        <?php endif; ?>
	                    <?php if ( $preferred_neighbor_enabled ) : ?>
                            <li>
                                <input type="radio" name="dhl_preferred_location_type" id="dhl-preferred_location-neighbor" class="" value="neighbor" <?php checked( 'neighbor', $preferred_location_type ); ?> />
                                <label for="dhl-preferred_location-neighbor"><?php _ex( 'Neighbor', 'dhl', 'woocommerce-germanized' ); ?></label>
                            </li>
	                    <?php endif; ?>
                    </ul>

                    <?php if ( $preferred_location_enabled ) : ?>
                        <div class="dhl-preferred-service-item dhl-preferred-service-location-data dhl-preferred-service-location-place dhl-hidden">
                            <div class="dhl-preferred-service-title"><?php _ex(  'Preferred location: Delivery to your preferred drop-off location', 'dhl', 'woocommerce-germanized' ); ?> <?php echo wc_help_tip( _x( 'Choose a weather-protected and non-visible place on your property, where we can deposit the parcel in your absence.', 'dhl', 'woocommerce-germanized' ) ); ?></div>
                            <div class="dhl-preferred-service-data">
                                <input type="text" name="dhl_preferred_location" id="dhl-preferred-location" class="" value="<?php echo esc_attr( $preferred_location ); ?>" maxlength="80" placeholder="<?php echo esc_attr( _x( 'e.g. Garage, Terrace', 'dhl', 'woocommerce-germanized' ) ); ?>" />
                            </div>
                        </div>
                    <?php endif; ?>

	                <?php if ( $preferred_neighbor_enabled ) : ?>
                        <div class="dhl-preferred-service-item dhl-preferred-service-location-data dhl-preferred-service-location-neighbor dhl-hidden">
                            <div class="dhl-preferred-service-title"><?php _ex(  'Preferred neighbour: Delivery to a neighbour of your choice', 'dhl', 'woocommerce-germanized' ); ?> <?php echo wc_help_tip( _x( 'Determine a person in your immediate neighborhood whom we can hand out your parcel in your absence. This person should live in the same building, directly opposite or next door.', 'dhl', 'woocommerce-germanized' ) ); ?></div>
                            <div class="dhl-preferred-service-data">
                                <input type="text" name="dhl_preferred_location_neighbor_name" id="dhl-preferred-location-neighbor-name" class="" value="<?php echo esc_attr( $preferred_location_neighbor_name ); ?>" maxlength="25" placeholder="<?php echo esc_attr( _x( 'First name, last name of neighbor', 'dhl', 'woocommerce-germanized' ) ); ?>" />
                                <input type="text" name="dhl_preferred_location_neighbor_address" id="dhl-preferred-location-neighbor-address" class="" value="<?php echo esc_attr( $preferred_location_neighbor_address ); ?>" maxlength="55" placeholder="<?php echo esc_attr( _x( 'Street, number, postal code, city', 'dhl', 'woocommerce-germanized' ) ); ?>" />
                            </div>
                        </div>
	                <?php endif; ?>
                </div>
            </div>
		<?php endif; ?>

		<?php if ( $preferred_day_enabled && $preferred_time_enabled && ! empty( $preferred_day_time_cost ) ) : ?>
            <div class="dhl-preferred-service-cost">
                <?php printf( _x( '* For a booking of preferred day and preferred time in combination there is a surcharge of %s incl. VAT', 'dhl', 'woocommerce-germanized' ), wc_price( $preferred_day_time_cost ) ); ?>
            </div>
		<?php endif; ?>
    </td>
</tr>
