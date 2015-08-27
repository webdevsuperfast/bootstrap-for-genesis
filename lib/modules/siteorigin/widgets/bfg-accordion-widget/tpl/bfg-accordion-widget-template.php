<?php
echo '<div>';
    $title = $instance['title'];
    $content = $instance['content'];

    if ( $title )
        echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];

    if ( $content && !is_wp_error( $content ) ) {
        $count = 0;
        echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
        foreach( $content as $cont ) {
            echo '<div class="panel panel-default">';
                echo '<div class="panel-heading" role="tab" id="heading'.$count.'">';
                    echo '<h4 class="panel-title">';
                        echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$count.'" aria-expanded="'.( $count == '0' ? 'true' : 'false' ).'" aria-controls="collapse'.$count.'">';
                            echo $cont['heading'];
                        echo '</a>';
                    echo '</h4>';
                echo'</div><!-- end .panel-heading -->';

                echo '<div id="collapse'.$count.'" class="panel-collapse collapse'.( $count == '0' ? ' in' : '' ).'" role="tabpanel" aria-labelledby="heading'.$count.'">';
                    echo '<div class="panel-body">';
                        echo wpautop( $cont['body'], false );
                    echo '</div><!-- end .panel-body -->';
                echo '</div><!-- end .panel-collapse -->';
            echo '</div><!-- end .panel -->';
            $count++;
        }
        echo '</div>';
    }
echo '</div>';
