<div class="wrap erp erp-company-single">
    <h2><?php _e( 'Company', 'wp-erp' ); ?> <a href="<?php echo admin_url( 'admin.php?page=erp-company&action=new' ); ?>" class="add-new-h2"><?php _e( 'New Company', 'wp-erp' ); ?></a></h2>

    <?php $country = \WeDevs\ERP\Countries::instance(); ?>

    <form action="" method="post" id="erp-new-company">
        <div class="erp-single-container">
            <div class="erp-area-left">
                <div id="titlediv" style="margin-bottom: 20px;">
                    <div id="titlewrap">
                        <label class="screen-reader-text" id="title-prompt-text" for="title"><?php _e( 'Enter company name here', 'wp-erp' ); ?></label>
                        <input type="text" name="company_name" size="30" value="<?php echo esc_attr( $company->name ); ?>" id="title" autocomplete="off">
                    </div>
                </div>

                <div class="postbox company-postbox">
                    <h3 class="hndle"><span><?php _e( 'Company Information', 'wp-erp' ); ?></span></h3>
                    <div class="inside">

                        <table class="form-table">
                            <tr>
                                <td><label for="address_1"><?php _e( 'Address Line 1 ', 'wp-erp' ); ?></label></td>
                                <td><input type="text" id="address_1" class="regular-text" name="address_1" value="<?php echo esc_attr( $company->address_1 ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="address_2"><?php _e( 'Address Line 2 ', 'wp-erp' ); ?></label></td>
                                <td><input type="text" id="address_2" class="regular-text" name="address_2" value="<?php echo esc_attr( $company->address_2 ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="city"><?php _e( 'City', 'wp-erp' ); ?></label></td>
                                <td><input type="text" id="city" class="regular-text" name="city" value="<?php echo esc_attr( $company->city ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="state"><?php _e( 'Province / State', 'wp-erp' ); ?></label></td>
                                <td>
                                    <select name="state" id="erp-state" class="erp-state-select">
                                        <?php
                                        if ( $company->country ) {
                                            $states = $country->get_states( $company->country );
                                            echo erp_html_generate_dropdown( $states, $company->state );
                                        } else {
                                            ?>
                                            <option value="-1"><?php _e( '- Select -', 'wp-erp' ); ?></option>
                                        <?php } ?>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="erp-country"><?php _e( 'Country', 'wp-erp' ); ?></label> <span class="required">*</span></td>
                                <td>
                                    <select name="country" id="erp-country" data-parent="table" class="erp-country-select">
                                        <?php echo $country->country_dropdown( $company->country ); ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="zip"><?php _e( 'Postal / Zip Code', 'wp-erp' ); ?></label></td>
                                <td><input type="number" id="zip" class="regular-text" name="zip" value="<?php echo esc_attr( $company->zip ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="phone"><?php _e( 'Phone', 'wp-erp' ); ?></label></td>
                                <td><input type="text" id="phone" class="regular-text" name="phone" value="<?php echo esc_attr( $company->phone ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="fax"><?php _e( 'Fax', 'wp-erp' ); ?></label></td>
                                <td><input type="text" id="fax" class="regular-text" name="fax" value="<?php echo esc_attr( $company->fax ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="mobile"><?php _e( 'Mobile', 'wp-erp' ); ?></label></td>
                                <td><input type="text" id="mobile" class="regular-text" name="mobile" value="<?php echo esc_attr( $company->mobile ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="website"><?php _e( 'Website', 'wp-erp' ); ?></label></td>
                                <td><input type="url" id="website" class="regular-text" name="website" value="<?php echo esc_url( $company->website ); ?>"></td>
                            </tr>

                            <tr>
                                <td><label for="currency"><?php _e( 'Main Currency', 'wp-erp' ); ?></label></td>
                                <td>
                                    <select name="currency" id="currency">
                                        <?php echo erp_get_currencies_dropdown( $company->currency ); ?> ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div><!-- .inside -->
                </div><!-- .postbox -->

                <div class="company-location-wrap">
                    <h2>
                        <?php _e( 'Locations', 'wp-erp' ); ?>

                        <a href="#" id="erp-company-new-location" class="add-new-h2" data-title="<?php _e( 'New Location', 'wp-erp' ); ?>" data-id="<?php echo $company->id; ?>"><?php _e( 'Create New Location', 'wp-erp' ); ?></a>
                    </h2>

                    <div id="company-locations">
                        <div id="company-locations-inside">
                        <?php
                        $locations = erp_get_company_locations( $company->id );

                        if ( $locations ) {
                            foreach ($locations as $num => $location) {
                                ?>
                                <div class="company-location postbox">
                                    <h3 class="hndle"><?php echo wp_kses_post( $location->name ); ?></h3>

                                    <div class="inside">
                                        <address class="address">
                                            <?php
                                            echo $country->get_formatted_address( array(
                                                'address_1' => $location->address_1,
                                                'address_2' => $location->address_2,
                                                'city'      => $location->city,
                                                'state'     => $location->state,
                                                'postcode'  => $location->zip,
                                                'country'   => $location->country
                                            ) );
                                            ?>
                                        </address>
                                    </div><!-- .inside -->

                                    <div class="actions">
                                        <a href="#" class="edit-location" data-data='<?php echo json_encode( $location ); ?>'><span class="dashicons dashicons-edit"></span></a>
                                        <a href="#" class="remove-location" data-id="<?php echo $location->id; ?>"><span class="dashicons dashicons-trash"></span></a>
                                    </div>
                                </div>

                                <?php
                            }
                        } else {
                            _e( 'No extra locations found!', 'wp-erp' );
                        }
                        ?>
                        </div><!-- #company-locations-inside -->
                    </div><!-- #company-locations -->
                </div><!-- .company-location-wrap -->
            </div><!-- .erp-area-left -->

            <div class="erp-area-right">
                <div class="postbox company-logo" id="postimagediv">
                    <h3 class="hndle"><span><?php _e( 'Company Logo', 'wp-erp' ); ?></span></h3>
                    <div class="inside">

                        <?php echo $company->get_logo(); ?>

                        <?php if ( $company->has_logo() ) { ?>

                            <p class="hide-if-no-js">
                                <input type="hidden" name="company_logo_id" value="<?php echo $company->logo; ?>">
                                <a href="#" class="remove-logo"><?php _e( 'Remove company logo', 'wp-erp' ); ?></a>
                            </p>

                        <?php } else { ?>

                            <p class="hide-if-no-js">
                                <a href="<?php echo get_upload_iframe_src('image' ); ?>" id="set-company-thumbnail" class="thickbox"><?php _e( 'Upload company logo', 'wp-erp' ); ?></a>
                            </p>

                        <?php } ?>
                    </div>
                </div><!-- .postbox -->

                <div class="postbox company-postbox">
                    <h3 class="hndle"><span><?php _e( 'Actions', 'wp-erp' ); ?></span></h3>
                    <div class="inside">
                        <div class="submitbox" id="submitbox">
                            <div id="major-publishing-actions">

                                <div id="publishing-action">

                                    <?php $button_text = $company->id ? __( 'Update Company', 'wp-erp' ) : __( 'Create Company', 'wp-erp' ); ?>
                                    <?php wp_nonce_field( 'erp-new-company' ); ?>
                                    <input type="hidden" name="erp-action" value="create_new_company">
                                    <input type="hidden" name="company_id" value="<?php echo $company->id; ?>">
                                    <input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="<?php echo $button_text; ?>">
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- .postbox -->
            </div><!-- .leads-right -->
        </div><!-- .erp-single-container -->
    </form>
</div>