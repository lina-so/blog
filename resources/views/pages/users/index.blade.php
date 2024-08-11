@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ user
                    list</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <x-alert.alert name="success" type="success" msg="user added successfully" />

    <x-alert.alert name="update" type="success" msg="user updated successfully" />


    <x-alert.alert name="delete" type="error" msg="user deleted successfully" />



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a class="modal-effect btn btn-outline-primary btn-md" data-effect="effect-scale" data-toggle="modal"
                        href="#modaldemo4"> Add user</a>

                </div>


                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0"> name</th>
                                    <th class="border-bottom-0">email</th>
                                    <th class="border-bottom-0">password</th>
                                    <th class="border-bottom-0">process</th>


                                    <th class="border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($users as $user)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->password }}</td>


                                        <td>
                                            <a class="modal-effect btn btn-sm btn-warning " data-effect="effect-scale"
                                                href="#modaldemo9{{ $user->id }}" data-toggle="modal" title="تعديل"><i
                                                    class="las la-edit"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#modaldemo6{{ $user->id }}" title="حذف"><i
                                                    class="las la-trash"></i></a>

                                            <a class=" btn btn-sm btn-success" role="button" aria-pressed="true"
                                                data-id="{{ $user->id }}" href="{{ route('users.show', $user->id) }}"
                                                title="show"><i class="las la-eye"></i></a>
                                        </td>
                                        <td></td>

                                    </tr>

                                    <!-- delete -->
                                    <div class="modal" id="modaldemo6{{ $user->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Delete user</h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="form-group">

                                                        <x-form.input name="id" type="hidden" :value="$user->id" />

                                                    </div>

                                                    <div class="modal-body">
                                                        <p>? Are you sure you want to delete this user</p><br>
                                                        <br>
                                                        <x-form.input name="title" type="text" :value="$user->email" />
                                                        : user email
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

                                    <!-- Edit modal -->
                                    <div class="modal" id="modaldemo9{{ $user->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Edit user</h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('users.update', $user->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    {{ method_field('patch') }}
                                                    {{ csrf_field() }}

                                                    <div class="modal-body">
                                                        <x-form.input name="user_id" type="hidden" />

                                                        <div class="form-group">
                                                            <x-form.input name="name" type="text" label="user name"
                                                                :value="$user->name" />
                                                        </div>

                                                        <div class="form-group">
                                                            <x-form.input name="email" type="email"
                                                                label="user email" :value="$user->email" />
                                                        </div>

                                                        {{-- <div class="form-group">
                                                            <x-form.input name="password" type="text"
                                                                label="user password" :value="$user->password" />
                                                        </div>

                                                        <div class="form-group">
                                                            <x-form.input name="password_confirmation"
                                                            type="password" label="confirm password" :value="$user->password" />
                                                        </div> --}}

                                                    </div>


                                                    <div class="modal-footer">
                                                        <button class="btn  btn-primary" type="submit">save</button>
                                                        <button class="btn  btn-secondary" data-dismiss="modal"
                                                            type="button">cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach




                            </tbody>
                        </table>
                        @if (count($users) >= 10)
                            <div class="pagination">
                                {{ $users->links() }}
                            </div>
                        @else
                            <div></div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Basic modal -->
    <div class="modal" id="modaldemo4">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> Add user</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <x-form.input name="user_id" type="hidden" />


                        <div class="form-group">
                            <x-form.input name="name" type="text" label="user name" :value="null" />
                        </div>

                        <div class="form-group">
                            <x-form.input name="email" type="email" label="user email" :value="null" />
                        </div>

                        <div class="form-group">
                            <x-form.input name="password" type="password" label="user password" :value="null" />
                        </div>


                        <div class="form-group">
                            <x-form.input name="password_confirmation" type="password" label="confirm password" :value="null" />
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn  btn-primary" type="submit">save</button>
                        <button class="btn  btn-secondary" data-dismiss="modal" type="button">cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}">
        < script src = "{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}" >
    </script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>



    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
