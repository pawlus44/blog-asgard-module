<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.name") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[name]", trans('blog::category.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("{$lang}[name]"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::category.form.name')]) !!}
        {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("{$lang}.display_name") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[display_name]", trans('blog::category.form.display_name')) !!}
        {!! Form::text("{$lang}[display_name]", old("{$lang}[display_name]"), ['class' => 'form-control', 'placeholder' => trans('blog::category.form.display_name')]) !!}
        {!! $errors->first("{$lang}.display_name", '<span class="help-block">:message</span>') !!}
    </div>    
    <div class='form-group{{ $errors->has("{$lang}.slug") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[slug]", trans('blog::category.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("{$lang}[slug]"), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::category.form.slug')]) !!}
       {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
   </div>
</div>
