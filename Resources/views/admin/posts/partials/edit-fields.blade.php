<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        <?php $oldTitle = isset($post->translate($lang)->title) ? $post->translate($lang)->title : ''; ?>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title", $oldTitle), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
        <?php $oldSlug = isset($post->translate($lang)->slug) ? $post->translate($lang)->slug : ''; ?>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug", $oldSlug), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<span class="help-block">:message</span>') !!}
    </div>
    <?php $old = isset($post->translate($lang)->content) ? $post->translate($lang)->content : ''; ?>

    @editor('short_content', trans('blog::post.form.short_content'), $post->short_content, $lang)

    @editor('content', trans('blog::post.form.content'), old("$lang.content", $old), $lang)

    <div class='form-group{{ $errors->has("publish_date") ? ' has-error' : '' }}'>
        {!! Form::label("publish_date", trans('blog::post.form.publish date')) !!}
        <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input date-settime="{{$post->publish_date }}" name="publish_date" type="text" value="{{$post->publish_date }}" id="publish_date" class="form-control datetimepicker-set-data">
        </div>
    </div>

    @documentMultiple('document', route('media.grid.type',['type' => 'text_documents']), $post)

    <?php if (config('asgard.blog.config.post.partials.translatable.edit') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.edit') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
