@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Role', 'title_2' => 'Settings'])
    <div class="row mt-1 px-1">
        <div class="col-12">
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> {{ session('error') }}</strong>
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Role Access {{ $role->display_name }}</h4>
                    <p class="sub-title">Please Select Role Modules To Set Permissions!</p>
                    @php
                        $accordion = 0;
                    @endphp
                    <div class="row mb-3 justify-content-center">
                        <div class="col-sm-6">
                            <form action="{{ route('roles.access', $role->id) }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..."
                                        value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($module as $item)
                            <div class="col-md-6">
                                <div id="accordion">
                                    <div class="card mb-2 border border-primary" id="{{ $accordion }}">
                                        <div class="card-header" id="headingOne{{ $item->id }}">
                                            <h5 class="mb-0 mt-0 font-14">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne{{ $item->id }}"
                                                    aria-expanded="{{ $accordion == 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapseOne{{ $item->id }}" class="text-dark">
                                                    {{ $item->name }}
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapseOne{{ $item->id }}"
                                            class="collapse false{{ $accordion == 0 ? 'show' : '' }}"
                                            aria-labelledby="headingOne{{ $item->id }}" style=""
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                @foreach ($item->permission as $row)
                                                    <div class="icheck-material-secondary icheck-inline">
                                                        @php
                                                            $permission_with_role = $row->permission_with_role($row->id, $role->id);
                                                        @endphp
                                                    </div>
                                                    <div class="icheck-material-secondary icheck-inline">
                                                        @if (!empty($permission_with_role))
                                                            @if ($row->id == $permission_with_role->permission_id)
                                                                <input type="checkbox"
                                                                    id="inlineCheckbox{{ $row->id }}"
                                                                    value="{{ $row->id }}" checked=""
                                                                    data-permission="{{ $row->name }}">
                                                                <label for="inlineCheckbox{{ $row->id }}">
                                                                    {{ $row->display_name }} </label>
                                                            @endif
                                                        @else
                                                            <input type="checkbox" id="inlineCheckbox{{ $row->id }}"
                                                                value="option{{ $row->id }}"
                                                                data-permission="{{ $row->name }}">
                                                            <label for="inlineCheckbox{{ $row->id }}">
                                                                {{ $row->display_name }} </label>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $accordion++;
                                    @endphp
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 d-flex justify-content-end">
                            {{ $module->links() }}
                        </div>
                        <div class="col-md-12 ">
                            <a href="{{ route('roles.index') }}" class="btn btn-danger btn-back">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("input[name=search]").keyup(function(e) {
                let val = $(this).val();
            });
            $(document).on('click', 'input[type=checkbox]', function(e) {
                if ($(this).is(':checked')) {
                    console.log("Checked")
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('permission.attach', $role->id) }}',
                        data: {
                            permission: $(this).data('permission')
                        },
                        success: function(data) {
                            $.toast({
                                heading: 'Success !',
                                text: 'Has been given access role',
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 1,
                                afterShown: function() {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                },
                            });
                        }
                    })
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('permission.detach', $role->id) }}',
                        data: {
                            permission: $(this).data('permission')
                        },
                        success: function(data) {
                            $.toast({
                                heading: 'Warning !',
                                text: 'Access role has been revoked',
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'warning',
                                hideAfter: 2000,
                                stack: 1,
                                afterShown: function() {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                },
                            });
                        }
                    })
                }
            });
        });
    </script>
@endsection
