<?php

namespace App\Orchid\Layouts;

use App\Models\Post;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class PostListLayout extends Table
{
    public $target = 'posts';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Title')
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.post.list', $post);
                }),
            TD::make('user.name', 'User Name')
                ->render(function (Post $post) {
                    return $post->user->name ?? '—';
                }),

            TD::make('created_at', 'Created'),
        ];
    }
}
