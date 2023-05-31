@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.blog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.blogs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row my-3">
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label class="required" for="date">{{ trans('cruds.blog.fields.date') }}</label>
                    <input class="form-control" type="date" name="date" id="date" value="{{ old('date', '') }}" placeholder="YYYY-MM-DD" required>
                    @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.title') }}</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', '') }}">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.photo') }}</label>
                    <input type="file" name="photo" class="form-control" value="{{ old('photo', '') }}">
                    @error('photo')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.body') }}</label>
                    <textarea name="body" id="" cols="30" rows="10" class="cke-editor" >{{ old('body', '') }}</textarea>
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
