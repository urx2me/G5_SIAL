<?php if (is_user_logged_in()) : ?>
<div id="comments">
    <?php
    global $post;
    $post_id = $post->ID;
    if (comments_open($post_id) || get_comments_number($post_id)) :
    ?>
        <div class="comments-area">
            <?php
            if (get_comments_number($post_id)) :
                $comments = get_comments(array('post_id' => $post_id));
                echo '<h2 class="comments-title">' . esc_html(get_comments_number($post_id)) . ' Comments</h2>';
                foreach ($comments as $comment) :
                    // Retrieve the profile picture URL from user meta
                    $user_id = $comment->user_id;
                    $profile_picture = get_user_meta($user_id, 'profile_picture', true);


                    ?>
                        
                    <div class="comment">
                        <div class="comment-author">
                            <?php if ($profile_picture) : ?>
                                <img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr($comment->comment_author); ?>" style="width: 50px; height: 50px; border-radius: 50%;">
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_avatar_url($comment->comment_author_email)); ?>" alt="<?php echo esc_attr($comment->comment_author); ?>" style="width: 50px; height: 50px; border-radius: 50%;">
                            <?php endif; ?>
                        </div>
                        <div class="comment-content">
                            <div class="comment-author-name"><?php echo esc_html($comment->comment_author); ?></div>
                            <div class="comment-text"><?php echo esc_html($comment->comment_content); ?></div>
                            <div class="comment-date"><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($comment->comment_date))); ?></div>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>

        <?php if (comments_open($post_id)) : ?>
            <div class="comment-form">
                <?php
                comment_form(array(
                    'title_reply' => 'Leave a Comment',
                ));
                ?>
            </div>
        <?php else : ?>
            <p>Comments are closed.</p>
        <?php endif; ?>
    <?php else : ?>
        <p>Comments are closed.</p>
    <?php endif; ?>
</div>
<?php else : ?>
    <!-- Message for non-logged-in users -->
    <p>You must be logged in to post a comment.</p>
<?php endif; ?>