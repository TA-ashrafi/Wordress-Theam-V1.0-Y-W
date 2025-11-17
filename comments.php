<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(__('One comment on "%s"', 'tahseen-ashrafi'), get_the_title());
            } else {
                printf(
                    _n(
                        '%1$s comment on "%2$s"',
                        '%1$s comments on "%2$s"',
                        $comments_number,
                        'tahseen-ashrafi'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h3>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('Older Comments', 'tahseen-ashrafi'),
            'next_text' => __('Newer Comments', 'tahseen-ashrafi'),
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php echo __('Comments are closed.', 'tahseen-ashrafi'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'          => __('Leave a Comment', 'tahseen-ashrafi'),
        'title_reply_to'       => __('Leave a Reply to %s', 'tahseen-ashrafi'),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __('Comment', 'tahseen-ashrafi') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea></p>',
        'fields'               => array(
            'author' => '<p class="comment-form-author"><label for="author">' . __('Name', 'tahseen-ashrafi') . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" class="form-control" required /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __('Email', 'tahseen-ashrafi') . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" class="form-control" required /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . __('Website', 'tahseen-ashrafi') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" class="form-control" /></p>',
        ),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s see-more-btn">%4$s</button>',
        'class_submit'         => 'submit',
        'label_submit'         => __('Post Comment', 'tahseen-ashrafi'),
    ));
    ?>
</div>
