<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug"), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<span class="help-block">:message</span>') !!}
    </div>

    @editor('short_content', trans('blog::post.form.short_content'), old("{$lang}.short_content"), $lang)

    @editor('content', trans('blog::post.form.content'), old("{$lang}.content"), $lang)



    <div class='form-group{{ $errors->has("publish_date") ? ' has-error' : '' }}'>
        {!! Form::label("publish_date", trans('blog::post.form.publish date')) !!}
        <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input name="publish_date" type="text" value="" id="publish_date" class="form-control datetimepicker">
        </div>
    </div>


    @documentMultiple('document', route('media.grid.type',['type' => 'text_documents']))


    <?php if (config('asgard.blog.config.post.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.create') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>