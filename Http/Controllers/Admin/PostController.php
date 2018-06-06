<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Status;
use Modules\Blog\Http\Requests\CreatePostRequest;
use Modules\Blog\Http\Requests\UpdatePostRequest;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Blog\Repositories\PostRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;
use Illuminate\Support\Facades\Auth;

class PostController extends AdminBaseController
{
    /**
     * @var PostRepository
     */
    private $post;
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var FileRepository
     */
    private $file;
    /**
     * @var Status
     */
    private $status;

    public function __construct(
        PostRepository $post,
        CategoryRepository $category,
        FileRepository $file,
        Status $status
    ) {
        parent::__construct();
        $this->post = $post;
        $this->category = $category;
        $this->file = $file;
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->post->all();

        return view('blog::admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->category->allTranslatedIn(app()->getLocale());
        $statuses = $this->status->lists();

        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireJs('moment.js');
        $this->assetPipeline->requireJs('bootstrap-datetimepicker.js');
        $this->assetPipeline->requireCss('bootstrap-datetimepicker.min.css');
        $this->assetPipeline->requireJs('my-datetimepicker-script.js');

        $user = Auth::user();

        return view('blog::admin.posts.create', compact('categories', 'statuses', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request)
    {
        $this->post->create($request->all());

        return redirect()->route('admin.blog.post.index')
            ->withSuccess(trans('blog::messages.post created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $post);
        $categories = $this->category->allTranslatedIn(app()->getLocale());
        $statuses = $this->status->lists();
        $image = $this->file->findFileByZoneForEntity('image', $post);

        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireJs('moment.js');
        $this->assetPipeline->requireJs('bootstrap-datetimepicker.js');
        $this->assetPipeline->requireCss('bootstrap-datetimepicker.min.css');
        $this->assetPipeline->requireJs('my-datetimepicker-script.js');

        return view('blog::admin.posts.edit', compact('post', 'categories', 'thumbnail', 'statuses', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $post
     * @param UpdatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post, UpdatePostRequest $request)
    {
        $this->post->update($post, $request->all());
        $data = $request->all();
    
        if((int)$data['return']){
            return redirect()->route('admin.blog.post.edit',['post' => $post->id])
                ->withSuccess(trans('blog::messages.post updated')); 
        } else {
            return redirect()->route('admin.blog.post.index')
                ->withSuccess(trans('blog::messages.post updated'));        
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();

        $this->post->destroy($post);

        return redirect()->route('admin.blog.post.index')
            ->withSuccess(trans('blog::messages.post deleted'));
    }
}
