<div id="comments">
<?php
if ( have_comments() ) :

$args = array(
    'post_id' => get_the_ID(),   // Use post_id, not post_ID
);
$comments = get_comments($args);
$comments_count = count(get_comments( $args ));
?>
<div class="comments-area">
    
<h2 class="comments-title"><?php echo $comments_count; ?> Comments</h2>
<?php foreach($comments as $comment): ?>
<div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
            <div class="thumb" style="height: 50px; width: 50px;">
                <img src="" alt="" style="height: 100%;width: 100%;object-fit: cover;border-radius: 50%;">
            </div>
            <div class="desc">
                <p class="comment">
                    <?php echo $comment->comment_author; ?>
                </p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                    <h5>
                        <a href="#"><?php  echo $comment->comment_content;?></a>
                    </h5>
                    <p class="date"><?php echo date_format(date_create($comment->comment_date), 'Y-m-d H:i:s'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>

<?php


if ( !empty( $comments_by_type['pings'] ) ) :
$ping_count = count( $comments_by_type['pings'] );
?>
<section id="trackbacks-list" class="comments">
<h2 class="comments-title"><?php echo '<span class="ping-count">' . esc_html( $ping_count ) . '</span> ' . esc_html( _nx( 'Trackback or Pingback', 'Trackbacks and Pingbacks', $ping_count, 'comments count', 'blankslate' ) ); ?></h2>
<ul>
<?php wp_list_comments( 'type=pings&callback=blankslate_custom_pings' ); ?>
</ul>
</section>
<?php
endif;
endif;
// global $post;
// $author_id = $post->post_author;
// if ($author_id == get_current_user_id()) {
//     echo "You cannot comment your own post";
// } else {
    if ( comments_open() ) { comment_form(); }
// }
?>
</div>