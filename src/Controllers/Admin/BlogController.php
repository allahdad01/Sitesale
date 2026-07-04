<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Post;

class BlogController
{
    public function index(): void
    {
        View::render('admin.blog.index', [
            'title' => 'Blog Posts',
            'posts' => Post::allAdmin(),
        ], 'admin');
    }

    public function add(): void
    {
        View::render('admin.blog.form', [
            'title' => 'New Post',
            'post'  => null,
        ], 'admin');
    }

    public function store(Request $request): void
    {
        $slug = $request->post('slug', '');
        if (empty($slug)) $slug = Post::slugify($request->post('title', ''));

        $image = $this->handleUpload('image');

        Post::create([
            'title'        => $request->post('title', ''),
            'slug'         => $slug,
            'excerpt'      => $request->post('excerpt', ''),
            'content'      => $request->post('content', ''),
            'image'        => $image,
            'author'       => $request->post('author', ''),
            'category'     => $request->post('category', ''),
            'featured'     => (int) $request->post('featured', 0),
            'published_at' => $request->post('published_at', date('Y-m-d H:i:s')),
            'active'       => (int) $request->post('active', 1),
        ]);

        Session::set('_success', 'Post created.');
        Response::redirect(base_url('admin/blog'));
    }

    public function edit(Request $request): void
    {
        $post = Post::find((int) $request->param('id'));
        if (!$post) { Session::set('_error', 'Not found.'); Response::redirect(base_url('admin/blog')); return; }

        View::render('admin.blog.form', [
            'title' => 'Edit Post',
            'post'  => $post,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $id = (int) $request->param('id');
        $post = Post::find($id);
        if (!$post) { Session::set('_error', 'Not found.'); Response::redirect(base_url('admin/blog')); return; }

        $image = $post['image'];
        $uploaded = $this->handleUpload('image');
        if ($uploaded) {
            if ($image) @unlink(__DIR__ . '/../../../storage/uploads/' . $image);
            $image = $uploaded;
        }

        Post::update($id, [
            'title'        => $request->post('title', ''),
            'slug'         => $request->post('slug', ''),
            'excerpt'      => $request->post('excerpt', ''),
            'content'      => $request->post('content', ''),
            'image'        => $image,
            'author'       => $request->post('author', ''),
            'category'     => $request->post('category', ''),
            'featured'     => (int) $request->post('featured', 0),
            'published_at' => $request->post('published_at', date('Y-m-d H:i:s')),
            'active'       => (int) $request->post('active', 1),
        ]);

        Session::set('_success', 'Post updated.');
        Response::redirect(base_url('admin/blog'));
    }

    public function toggleFeatured(Request $request): void
    {
        Post::toggleFeatured((int) $request->param('id'));
        Session::set('_success', 'Featured status toggled.');
        Response::redirect(base_url('admin/blog'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        $post = Post::find($id);
        if ($post && $post['image']) {
            @unlink(__DIR__ . '/../../../storage/uploads/' . $post['image']);
        }
        Post::delete($id);
        Session::set('_success', 'Post deleted.');
        Response::redirect(base_url('admin/blog'));
    }

    private function handleUpload(string $field): string|null
    {
        if (empty($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return null;
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) return null;
        $filename = $field . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        move_uploaded_file($_FILES[$field]['tmp_name'], __DIR__ . '/../../../storage/uploads/' . $filename);
        return $filename;
    }
}
