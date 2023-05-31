@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.blog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.blogs.update", [$blog->id]) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="row my-3">
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label class="required" for="date">{{ trans('cruds.blog.fields.date') }}</label>
                    <input class="form-control" type="date" name="date" id="date" value="{{ old('date', $blog->date) }}" placeholder="YYYY-MM-DD" required>
                    @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.title') }}</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}">

                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.photo') }}</label>
                    <input type="file" name="photo" class="form-control" value="{{ old('photo', $blog->photo) }}">
                    <div class="text-end me-3 mt-2">
                        <img src="{{ asset('/storage/photos/'.$blog->photo) }}" width="100" height="60" alt="">
                    </div>
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.body') }}</label>
                    <textarea name="body" id="" cols="30" rows="10" class=" form-control cke-editor">{{ old('body', $blog->body) }}</textarea>
                    @error('body')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>
            <div class="form-group ">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '.cke-editor' ) )
            .catch( error => {
                console.error( error );
        } )

        $(function () {
            let date = document.querySelector('#date');
            if(date) {
                date.flatpickr({
                    dateFormat: "Y-m-d",
                })
            }
        })
    </script>

@endsection
