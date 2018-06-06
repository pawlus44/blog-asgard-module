<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Support\Facades\App;
use Modules\Blog\Repositories\PostRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Setting\Contracts\Setting;

class PublicController extends BasePublicController
{
    /**
     * @var PostRepository
     */
    private $post;

    /**
     * @var Setting
     */
    private $setting;

    public function __construct(PostRepository $post, Setting $setting)
    {
        parent::__construct();
        $this->post = $post;
        $this->setting = $setting;
    }

    public function index($pageNumber=1)
    {
        $postsPerPage = $this->setting->get('blog::posts-per-page', locale());
        $posts = $this->post->getPostForPage($pageNumber, $postsPerPage);
        $numberOfPosts = $this->post->count();

        return view('blog.index', compact('posts', 'pageNumber', 'postsPerPage', 'numberOfPosts'));
    }

    public function show($slug)
    {
        $post = $this->post->findBySlug($slug);
        return view('blog.show', compact('post'));
    }
}
