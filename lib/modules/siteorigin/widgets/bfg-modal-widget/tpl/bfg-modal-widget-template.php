<?php
echo '<div>';

$title = $instance['title'];
$settings = $instance['settings'];
$id = $settings['settings_id'];
$button = $instance['button'];
$body = $instance['body'];
$footer = $instance['footer'];

if ( $button ) {
    echo '<button type="button" class="btn'.( $button['button_class'] ? ' '. $button['button_class'] : '' ).'" data-toggle="modal" data-target="#'.$id.'">'.do_shortcode( $button['button_text'] ).'</button>';

    echo '<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">';
        echo '<div class="modal-dialog '.$settings['settings_size'].'" role="document">';
            echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    echo '<h4 class="modal-title" id="myModalLabel'.$id.'">'.apply_filters( 'widget_title', $title ).'</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
                    echo wpautop( $body['body_text'], false );
                echo '</div>';
                echo '<div class="modal-footer">';
                    echo wpautop( $footer['footer_text'], false );
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

echo '</div>';