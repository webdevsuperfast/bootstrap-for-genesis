<?php
echo '<div>';
    $title = $instance['title'];
    $content = $instance['content'];

    if ( $title )
        echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];

    if ( $content && !is_wp_error( $content ) ) {
        $count = 0;
        echo '<ul class="nav nav-tabs" role="tablist">';
        foreach( $content as $cont ) {
            echo '<li role="presentation" class="'.( $count == '0' ? 'active' : '' ).'"><a href="#tab'.$count.'" aria-controls="tab'.$count.'" role="tab" data-toggle="tab">'.$cont['heading'].'</a></li>';
            $count++;
        }
        echo '</ul>';
        $list = 0;
        echo '<div class="tab-content">';
        foreach( $content as $body ) {
            echo '<div role="tabpanel" class="tab-pane fade'.( $list == '0' ? ' in active' : '' ).'" id="tab'.$list.'">';
                echo wpautop( $body['body'], false );
            echo '</div>';
            $list++;
        }
        echo '</div>';
    }
echo '</div>';
