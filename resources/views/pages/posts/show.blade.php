@extends('layouts.master')
@section('css')
@section('title')
    Post Details

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    Post Details
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<!-- row opened -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog's post</h3>
                <a class="modal-effect btn btn-sm btn-warning " data-effect="effect-scale"
                    href="#modaldemo9{{ $post->id }}" data-toggle="modal" title="تعديل"><i
                        class="las la-edit"></i></a>
            </div>
            <div class="card-body">
                <div id="accordion" class="w-100 br-2 overflow-hidden">


                    <div class="">
                        <div class="accor  bg-primary" id="headingThree3">
                            <h4 class="m-0">
                                <a href="#collapseThree1" class="collapsed" data-toggle="collapse" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    {{ $post->title }} <i class="si si-cursor-move ml-2"></i>
                                </a>

                            </h4>
                        </div>

                        <div id="collapseThree1" class="collapse b-b0 bg-white" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="border p-3">

                                <table class="table mb-0 table-bordered border-top mb-0">

                                    <thead>
                                        <tr>
                                            <th>blog Name</th>
                                        </tr>
                                    </thead>
                                    @foreach ($post->blogs as $blog)
                                        <tbody>
                                            <tr>
                                                <td>{{ $blog->name }}</td>
                                            </tr>

                                            <!-- Edit blog -->
                                            <div class="modal" id="modaldemo9{{ $post->id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title"> Edit blog</h6><button
                                                                aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form action="{{ route('updateBlog', $post->id) }}"
                                                            method="post">
                                                            {{ method_field('put') }}
                                                            {{ csrf_field() }}

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label> blog</label>
                                                                    <select class="custom-select my-1 mr-sm-2"
                                                                        name="blogs[]" multiple>
                                                                        <option selected disabled>choose...</option>
                                                                        @foreach ($blogs as $blog)
                                                                            <option style="color: black"
                                                                                value="{{ $blog->id }}">
                                                                                {{ $blog->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button class="btn  btn-primary"
                                                                    type="submit">save</button>
                                                                <button class="btn  btn-secondary" data-dismiss="modal"
                                                                    type="button">cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tbody>
                                    @endforeach

                                </table>

                            </div>

                        </div>
                    </div>

                    <div class="">
                        <div class="accor bg-primary" id="headingOne1">
                            <h4 class="m-0">
                                <a href="#collapseOne1" class="" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                   Comments <i class="si si-cursor-move ml-2"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            @foreach ($post->comments as  $comment)
                            <div class="border p-3">
                                {{ $comment->content }}
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
