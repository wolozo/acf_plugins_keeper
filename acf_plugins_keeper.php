<?php

/*
 * Plugin Name:       acf_plugins_keeper
 * Plugin URI:        https://github.com/wolozo/acf_plugins_keeper
 * GitHub Plugin URI: https://github.com/wolozo/acf_plugins_keeper
 * Description:       Help keep the WordPress Plugins page tidy by hiding plugins.
 * Version:           0.0.2
 * Author:            Wolozo
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acf_plugins_keeper
 * Requires WP:       4.3
 * Requires PHP:      5.3
 */

/**
 * Test for required plugins
 */
function w_acfpk_checkPlugins() {
  $thisPlugin = '<b>acf_plugins_keeper</b>';

  $manage_options = current_user_can( 'manage_options' );

  if ( ! function_exists( 'acf_add_options_page' ) && $manage_options ) {

    add_action( 'admin_notices',
      function () use ( &$thisPlugin ) {
        $ACFPlugin = "<a href='https://www.advancedcustomfields.com/'>Advanced Custom Fields PRO</a>";
        ?>

        <div class="notice notice-warning">
          <p><?php _e( "The plugin $ACFPlugin is required. Please install and activate it or deactivate the plugin $thisPlugin",
                       'acfdgf' ); ?></p>
        </div>

      <?php } );
  }
}

add_action( 'admin_init', 'w_acfpk_checkPlugins' );

/**
 * Add acf_plugins_keeper option page to Admin menu
 *
 * /wp-admin/admin.php?page=acf_plugins_keeper
 */
function w_acfpk_options() {
  if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
                            'page_title' => 'Plugin Keeper',
                            'menu_title' => 'Plugin Keeper',
                            'menu_slug'  => 'acf_plugins_keeper',
                            'icon_url'   => 'dashicons-admin-plugins',
                            'position'   => '100',
                          ) );
  }
}

add_action( 'init', 'w_acfpk_options' );

/**
 * Add ACF Fields to Options Page
 */
function w_acfpk_fields() {
  if ( function_exists( 'acf_add_local_field_group' ) ):

    acf_add_local_field_group( array(
                                 'key'                   => 'group_58becf3094e49',
                                 'title'                 => 'acf_plugins_keeper',
                                 'fields'                => array(
                                   array(
                                     'key'               => 'field_58becf36bc951',
                                     'label'             => 'Show for Allowed Users',
                                     'name'              => 'acfpk_show_for_users',
                                     'type'              => 'user',
                                     'instructions'      => '',
                                     'required'          => 0,
                                     'conditional_logic' => 0,
                                     'wrapper'           => array(
                                       'width' => '100',
                                       'class' => '',
                                       'id'    => '',
                                     ),
                                     'role'              => array(
                                       0 => 'administrator',
                                       1 => 'contributor',
                                       2 => 'editor',
                                       3 => 'author',
                                     ),
                                     'allow_null'        => 1,
                                     'multiple'          => 1,
                                   ),
                                   array(
                                     'key'               => 'field_58bed283f9878',
                                     'label'             => 'Show Plugin Keeper Menu Item to Allowed Users',
                                     'name'              => 'acfpk_show_plugin_keeper',
                                     'type'              => 'true_false',
                                     'instructions'      => '',
                                     'required'          => 0,
                                     'conditional_logic' => 0,
                                     'wrapper'           => array(
                                       'width' => '50',
                                       'class' => '',
                                       'id'    => '',
                                     ),
                                     'message'           => '',
                                     'default_value'     => 0,
                                     'ui'                => 0,
                                     'ui_on_text'        => '',
                                     'ui_off_text'       => '',
                                   ),
                                   array(
                                     'key'               => 'field_58bed675528cc',
                                     'label'             => 'Show as Normal When Plugin Update Is Available?',
                                     'name'              => 'acfpk_show_plugins_update',
                                     'type'              => 'true_false',
                                     'instructions'      => '',
                                     'required'          => 0,
                                     'conditional_logic' => 0,
                                     'wrapper'           => array(
                                       'width' => '50',
                                       'class' => '',
                                       'id'    => '',
                                     ),
                                     'message'           => '',
                                     'default_value'     => 0,
                                     'ui'                => 0,
                                     'ui_on_text'        => '',
                                     'ui_off_text'       => '',
                                   ),
                                   array(
                                     'key'               => 'field_58bed095fedf8',
                                     'label'             => 'Select Plugins to Hide',
                                     'name'              => 'acfpk_select_plugins_to_hide',
                                     'type'              => 'select',
                                     'instructions'      => '',
                                     'required'          => 0,
                                     'conditional_logic' => 0,
                                     'wrapper'           => array(
                                       'width' => '',
                                       'class' => '',
                                       'id'    => '',
                                     ),
                                     'choices'           => array(),
                                     'default_value'     => array(),
                                     'allow_null'        => 1,
                                     'multiple'          => 1,
                                     'ui'                => 1,
                                     'ajax'              => 0,
                                     'return_format'     => 'value',
                                     'placeholder'       => '',
                                   ),
                                 ),
                                 'location'              => array(
                                   array(
                                     array(
                                       'param'    => 'options_page',
                                       'operator' => '==',
                                       'value'    => 'acf_plugins_keeper',
                                     ),
                                   ),
                                   array(
                                     array(
                                       'param'    => 'current_user_role',
                                       'operator' => '==',
                                       'value'    => 'administrator',
                                     ),
                                   ),
                                 ),
                                 'menu_order'            => 0,
                                 'position'              => 'normal',
                                 'style'                 => 'default',
                                 'label_placement'       => 'top',
                                 'instruction_placement' => 'label',
                                 'hide_on_screen'        => '',
                                 'active'                => 1,
                                 'description'           => '',
                               ) );

  endif;
}

add_action( 'acf/init', 'w_acfpk_fields' );

/**
 * Lets hide our Admin menu option page
 */
function w_acfpk_remove_menu() {

  // Are allowed user able to see menu?
  if ( get_field( 'acfpk_show_plugin_keeper', 'options' ) ) {

    // Check if current user is allowed
    if ( is_array( $users = get_field( 'acfpk_show_for_users', 'options' ) ) ) {
      foreach ( $users as $index => $user ) {
        if ( $user[ 'ID' ] === get_current_user_id() ) {
          return;
        }
      }
    }
  }

  remove_menu_page( 'acf_plugins_keeper' );
}

add_action( 'admin_menu', 'w_acfpk_remove_menu', 999 );

/**
 * Populate acfpk_select_plugins_to_hide with list of Plugins
 */
function w_acfpk_load_plugin_list( $field ) {

  $plugins = array();

  foreach ( get_plugins() as $key => $value ) {
    $plugins[ $key ] = $value[ 'Title' ];
  }

  $field[ 'choices' ] = $plugins;

  return $field;
}

add_filter( 'acf/load_field/name=acfpk_select_plugins_to_hide', 'w_acfpk_load_plugin_list' );

/**
 * Hide the selected Plugins
 */
function w_acfpk_hide_plugins() {

  // Check if current user is allowed to see hidden plugins.
  if ( is_array( $users = get_field( 'acfpk_show_for_users', 'options' ) ) ) {

    foreach ( $users as $index => $user ) {
      if ( $user[ 'ID' ] === get_current_user_id() ) {
        return;
      }
    }
  }

  global $wp_list_table;

  $plugins   = get_field( 'acfpk_select_plugins_to_hide', 'options' );
  $plugins[] = 'acf_plugins_keeper/acf_plugins_keeper.php';

  foreach ( $wp_list_table->items as $key => $val ) {
    if ( in_array( $key, $plugins ) ) {

      // Should we show plugins when an update is available?
      if ( get_field( 'acfpk_show_plugins_update', 'options' ) && array_key_exists( 'update', $wp_list_table->items[ $key ] ) ) {
        continue;
      }

      unset( $wp_list_table->items[ $key ] );
    }
  }
}

add_action( 'pre_current_active_plugins', 'w_acfpk_hide_plugins', 0 );

function w_acfpk_hide_plugin_updates( $value ) {

  if ( ! isset( $value ) || ! is_object( $value ) || ! is_array( $value->response ) ) {
    return $value;
  }

  // Should we show plugins when an update is available?
  if ( get_field( 'acfpk_show_plugins_update', 'options' ) ) {
    return $value;
  }

  // Check if current user is allowed to see hidden plugins.
  if ( is_array( $users = get_field( 'acfpk_show_for_users', 'options' ) ) ) {

    foreach ( $users as $index => $user ) {
      if ( $user[ 'ID' ] === get_current_user_id() ) {
        return $value;
      }
    }
  }

  $plugins = get_field( 'acfpk_select_plugins_to_hide', 'options' );

  $plugins[] = 'acf_plugins_keeper/acf_plugins_keeper.php';

  foreach ( $value->response as $key => $values ) {
    if ( in_array( $key, $plugins ) ) {

      unset( $value->response[ $key ] );
    }
  }

  return $value;
}

add_filter( 'site_transient_update_plugins', 'w_acfpk_hide_plugin_updates' );
