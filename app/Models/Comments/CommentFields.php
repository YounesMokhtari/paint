<?php

namespace App\Models\Comments;

class CommentFields
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const BLOG_POST_ID = 'blog_post_id';
    public const CONTENT = 'content';
    public const CREATED_AT = 'created_at';
    public const MORPH_ID = 'commentable_id';
    public const MORPH_TYPE = 'commentable_type';
}
