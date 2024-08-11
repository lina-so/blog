@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">User post</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ $post->title }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <div class="card custom-card">
                <img class="card-img-top w-100 bg-danger-transparent" src="{{ URL::asset('assets/img/media/illustrate.png') }}" alt="">

                <div class="card-body">
                    <h4 class="card-title text-start">{{ $post->title }}</h4>
                    <p class="card-text text-start">{{ $post->content }}</p>

                    <hr>

                    <h6 class="text-end float-end">Leave a Comment</h6>
                    <form action="{{ route('comments.store') }}" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <x-form.input name="post_id" type="hidden" :value="$post->id" />
                        </div>

                        <div class="form-group">
                            <x-form.textarea name="content" rows="2" :value="null" ></x-form.textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>

                    <div class="d-flex flex-column align-items-end">
                        <div class="text-end">
                            @foreach ($post->comments->where('is_visible', true) as $comment)
                                <div class="mb-2">
                                    <strong>{{ $comment->author_name }}</strong>
                                    <p>{{ $comment->content }}</p>
                                    <a class=" btn btn-sm btn-danger" role="button" aria-pressed="true"
                                    data-id="{{ $comment->id }}" href="{{ route('comments.show', $comment->id) }}"
                                    title="show">hide</a>

                                    <a class=" btn btn-sm btn-success" role="button" aria-pressed="true"
                                    data-id="{{ $comment->id }}" href="{{ route('comments.show', $comment->id) }}"
                                    title="show">show</a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    data-toggle="modal" href="#modaldemo6{{ $comment->id }}" title="حذف"><i
                                        class="las la-trash"></i></a>
                                </div>

                                     <!-- delete -->
                                     <div class="modal" id="modaldemo6{{ $comment->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Delete comment</h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="form-group">

                                                        <x-form.input name="id" type="hidden" :value="$comment->id" />

                                                    </div>

                                                    <div class="modal-body">
                                                        <p>? Are you sure you want to delete this comment</p><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">cancel</button>
                                                        <button type="submit" class="btn btn-danger">save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- /row -->

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
