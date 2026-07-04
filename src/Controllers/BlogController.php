<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Models\Post;

class BlogController
{
    public function index(): void
    {
        $posts = Post::all();
        View::render('blog.index', [
            'title' => 'Our Blog',
            'posts' => $posts,
        ]);
    }

    public function show(Request $request): void
    {
        $post = Post::findBySlug($request->param('slug'));
        if (!$post) {
            View::render('errors.404', ['title' => 'Not Found'], 'main', 404);
            return;
        }
        $recentPosts = array_filter(Post::all(5), fn($p) => $p['id'] !== $post['id']);
        View::render('blog.show', [
            'title'       => $post['title'] . ' — Blog',
            'post'        => $post,
            'recentPosts' => $recentPosts,
        ]);
    }
}
