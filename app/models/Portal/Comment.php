<?php

namespace Model\Portal;

use Model\User;
use Model\Scopes\HasArticle;
use Model\Scopes\Published;

class Comment extends Model
{
    use HasArticle;
    use Published;
    
    protected $table = 'komentar';
    protected $dates = ['date'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class, 'artikel_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent')->orderBy('date', 'asc')->with('replies');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent');
    }

    public function getAvatarAttribute()
    {
        if ($this->user) {
            return $this->user->avatar;
        } else {
            $email_hash = md5(trim(strtolower($this->email)));

            return asset('../portal/assets/img/default_avatar_male.jpg');
        }
    }

    public function scopeArticleId($query, $article_id)
    {
        return $query->where('artikel_id', $article_id);
    }

    public function scopeParentOnly($query, $parent_id = 0)
    {
        return $query->where('parent', $parent_id);
    }

    public function getByArticle(Article $article)
    {
        $comments = Comment::articleId($article->id)
                        ->parentOnly()
                        ->with('replies')
                        ->latest('date')
                        ->get();

        return $comments;
    }

    public function scopePublished($query)
    {
        $query = $query->where('status', 'publish');

        return $query;
    }
}
