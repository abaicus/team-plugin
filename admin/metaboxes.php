<?php


  /* Adds a box to the main column on the Post and Page edit screens */
  function team_plugin_dynamic_add_custom_box() {
      add_meta_box(

          'dynamic_sectionid',
          __( 'Team Member Properties', 'team-plugin' ),
          'team_plugin_dynamic_render_inner_custom_box',
          'team-member',
          'normal',
          'high');
  }
  add_action( 'add_meta_boxes', 'team_plugin_dynamic_add_custom_box' );

  /* Do something with the data entered */
  add_action( 'publish_team-member', 'team_plugin_dynamic_save_postdata' );

  /* Prints the box content */
  function team_plugin_dynamic_render_inner_custom_box() {
      global $post;
      // Use nonce for verification
      wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
      ?>
      <div id="meta_inner">
        <div class="meta_tabs">
          <ul>
            <li><a class="general_options_tab active"><?php echo __('General Options','team-plugin'); ?></a></li>
            <li><a class="social_icons_tab"><?php echo __('Social Icons','team-plugin'); ?></a></li>
          </ul>
        </div>
        <div class="meta_social_screen">

        <?php
        $social_icons = array( 'No Icon','fa-envelope','fa-map-marker','fa-500px','fa-amazon','fa-android','fa-behance','fa-behance-square','fa-bitbucket','fa-bitbucket-square','fa-cc-amex','fa-cc-diners-club','fa-cc-discover','fa-cc-jcb','fa-cc-mastercard','fa-paypal','fa-cc-stripe','fa-cc-visa','fa-codepen','fa-css3','fa-delicious','fa-deviantart','fa-digg','fa-dribbble','fa-dropbox','fa-drupal','fa-facebook','fa-facebook-official','fa-facebook-square','fa-flickr','fa-foursquare','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-google','fa-google-plus','fa-google-plus-square','fa-html5','fa-instagram','fa-joomla','fa-jsfiddle','fa-linkedin','fa-linkedin-square','fa-opencart','fa-openid','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-rebel','fa-reddit','fa-reddit-square','fa-share-alt','fa-share-alt-square','fa-skype','fa-slack','fa-soundcloud','fa-spotify','fa-stack-overflow','fa-steam','fa-steam-square','fa-tripadvisor','fa-tumblr','fa-tumblr-square','fa-twitch','fa-twitter','fa-twitter-square','fa-vimeo','fa-vimeo-square','fa-vine','fa-whatsapp','fa-wordpress','fa-yahoo','fa-youtube','fa-youtube-play','fa-youtube-square');
        //get the saved meta as an arry
        $social_meta = get_post_meta($post->ID,'social_icons',true);
        $c = 0;
        if ( !empty( $social_meta )) {
            foreach( $social_meta as $social_icon ) {

                if ( isset( $social_icon['title'] ) || isset( $social_icon['track'] ) ) {

                  echo '<p> <label>Icon</label>';
                  echo '<select name="social_icons['.$c.'][icons]">';

                  foreach ($social_icons as  $value) {

                    echo '<option value='.$value.' '.($social_icon['icons'] == $value? 'selected':'' ).'>';
                    echo $value;
                    echo '</option>';

                  }

                  echo '</select>';

                  printf( '<label>Link</label> <input type="text" name="social_icons[%1$s][title]" value="%2$s" /> <span class="remove">%3$s</span></p>', $c, $social_icon['title'], __( 'Remove Icon', 'team-plugin' ) );

                  $c = $c +1;

                }
            }
        }



        ?>
    <span id="here"></span>
    <span class="add"><?php _e('Add Icon', 'team-plugin'); ?></span>
    <script>
        var $ =jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;
            $(".add").click(function() {
                count = count + 1;

                $('#here').append('<p> <label>Icon</label> <select name="social_icons['+count+'][icons]"><option value="No" icon="">No Icon</option><option value="fa-envelope">fa-envelope</option><option value="fa-map-marker">fa-map-marker</option><option value="fa-500px">fa-500px</option><option value="fa-amazon">fa-amazon</option><option value="fa-android">fa-android</option><option value="fa-behance">fa-behance</option><option value="fa-behance-square">fa-behance-square</option><option value="fa-bitbucket">fa-bitbucket</option><option value="fa-bitbucket-square">fa-bitbucket-square</option><option value="fa-cc-amex">fa-cc-amex</option><option value="fa-cc-diners-club">fa-cc-diners-club</option><option value="fa-cc-discover">fa-cc-discover</option><option value="fa-cc-jcb">fa-cc-jcb</option><option value="fa-cc-mastercard">fa-cc-mastercard</option><option value="fa-paypal">fa-paypal</option><option value="fa-cc-stripe">fa-cc-stripe</option><option value="fa-cc-visa">fa-cc-visa</option><option value="fa-codepen">fa-codepen</option><option value="fa-css3">fa-css3</option><option value="fa-delicious">fa-delicious</option><option value="fa-deviantart">fa-deviantart</option><option value="fa-digg">fa-digg</option><option value="fa-dribbble">fa-dribbble</option><option value="fa-dropbox">fa-dropbox</option><option value="fa-drupal">fa-drupal</option><option value="fa-facebook">fa-facebook</option><option value="fa-facebook-official">fa-facebook-official</option><option value="fa-facebook-square">fa-facebook-square</option><option value="fa-flickr">fa-flickr</option><option value="fa-foursquare">fa-foursquare</option><option value="fa-git">fa-git</option><option value="fa-git-square">fa-git-square</option><option value="fa-github">fa-github</option><option value="fa-github-alt">fa-github-alt</option><option value="fa-github-square">fa-github-square</option><option value="fa-google">fa-google</option><option value="fa-google-plus">fa-google-plus</option><option value="fa-google-plus-square">fa-google-plus-square</option><option value="fa-html5">fa-html5</option><option value="fa-instagram">fa-instagram</option><option value="fa-joomla">fa-joomla</option><option value="fa-jsfiddle">fa-jsfiddle</option><option value="fa-linkedin">fa-linkedin</option><option value="fa-linkedin-square">fa-linkedin-square</option><option value="fa-opencart">fa-opencart</option><option value="fa-openid">fa-openid</option><option value="fa-pinterest">fa-pinterest</option><option value="fa-pinterest-p">fa-pinterest-p</option><option value="fa-pinterest-square">fa-pinterest-square</option><option value="fa-rebel">fa-rebel</option><option value="fa-reddit">fa-reddit</option><option value="fa-reddit-square">fa-reddit-square</option><option value="fa-share-alt">fa-share-alt</option><option value="fa-share-alt-square">fa-share-alt-square</option><option value="fa-skype">fa-skype</option><option value="fa-slack">fa-slack</option><option value="fa-soundcloud">fa-soundcloud</option><option value="fa-spotify">fa-spotify</option><option value="fa-stack-overflow">fa-stack-overflow</option><option value="fa-steam">fa-steam</option><option value="fa-steam-square">fa-steam-square</option><option value="fa-tripadvisor">fa-tripadvisor</option><option value="fa-tumblr">fa-tumblr</option><option value="fa-tumblr-square">fa-tumblr-square</option><option value="fa-twitch">fa-twitch</option><option value="fa-twitter">fa-twitter</option><option value="fa-twitter-square">fa-twitter-square</option><option value="fa-vimeo">fa-vimeo</option><option value="fa-vimeo-square">fa-vimeo-square</option><option value="fa-vine">fa-vine</option><option value="fa-whatsapp">fa-whatsapp</option><option value="fa-wordpress">fa-wordpress</option><option value="fa-yahoo">fa-yahoo</option><option value="fa-youtube">fa-youtube</option><option value="fa-youtube-play">fa-youtube-play</option><option value="fa-youtube-square">fa-youtube-square</option></select><label>Link</label> <input type="text" name="social_icons['+count+'][title]" value="" /> <span class="remove">Remove Icon</span></p>' );
                return false;
            });
            $(".remove").live('click', function() {
                $(this).parent().remove();
            });
        });
        </script>
    </div>

    <div class="meta_general_screen">

      <?php // Member Role Metabox

      $role_meta = get_post_meta($post->ID,'role_text',true);
        echo '<p><label>Role</label><input type="text" name="role_text" value="' . $role_meta . '"></p>';

      $group_heading_meta = get_post_meta($post->ID,'group_heading_text',true);
        echo '<p><label>Groups Heading</label><input type="text" name="group_heading_text" value="' . $group_heading_meta . '"></p>';

      $description_meta = get_post_meta($post->ID,'description_text',true);
        echo '<p><label>Short Description </label><textarea name="description_text">' . $description_meta . '</textarea></p>';

      ?>
    </div>
  </div><?php
  }

  /* When the post is saved, saves our custom data */
  function team_plugin_dynamic_save_postdata( $post_id ) {
      // verify if this is an auto save routine.
      // If it is our form has not been submitted, so we dont want to do anything
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
          return;

      // verify this came from the our screen and with proper authorization,
      // because save_post can be triggered at other times
      if ( !isset( $_POST['dynamicMeta_noncename'] ) )
          return;

      if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
          return;

      // Save the data from metaboxes.

      $social_meta = $_POST['social_icons'];

      update_post_meta($post_id,'social_icons',$social_meta);

      $role_meta = $_POST['role_text'];

      update_post_meta($post_id,'role_text',$role_meta);

      $group_heading_meta = $_POST['group_heading_text'];

      update_post_meta($post_id,'group_heading_text',$group_heading_meta);

      $description_meta = $_POST['description_text'];

      update_post_meta($post_id,'description_text',$description_meta);
  }


?>
