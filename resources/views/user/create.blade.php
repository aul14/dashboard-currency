@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management', 'title_2' => 'Settings'])
    <div class="row mt-1 px-1">
        <div class="col-12">
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> {{ session('error') }}</strong>
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Form Add User</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="username">Username <span style="color: red;">*</span></label>
                                    <input type="text" value="{{ old('username') }}"
                                        class="form-control @error('username') is-invalid @enderror" required
                                        name="username" id="username">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="email">Email <span style="color: red;">*</span></label>
                                    <input type="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" required name="email"
                                        id="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span style="color: red;">*</span></label>
                                    <input type="password" value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror" required
                                        name="password" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Role <span style="color: red;">*</span></label>
                                    <select name="role_id" class="role-id" required>
                                        <option value="">Search</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="is_mng_sales">Is Manager Sales?</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" id="is_mng_sales" name="is_mng_sales"
                                            @checked(old('is_mng_sales') == 'yes') value="yes" data-toggle="toggle" data-on="Yes"
                                            data-off="No" data-onstyle="primary" data-offstyle="danger">
                                        @error('is_mng_sales')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_sales">Is Sales?</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" id="is_sales" name="is_sales" @checked(old('is_sales') == 'yes')
                                            value="yes" data-toggle="toggle" data-on="Yes" data-off="No"
                                            data-onstyle="primary" data-offstyle="danger">
                                        @error('is_sales')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group select-sales">
                                    <label for="salesman-code-1">Select Sales </label>
                                    <select name="salesman_code[]" id="salesman-code-1" class="salesman-code" multiple>
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" value="{{ old('firstname') }}"
                                        class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                        id="firstname">
                                    @error('firstname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" value="{{ old('lastname') }}"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        id="lastname">
                                    @error('lastname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" value="{{ old('address') }}"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        id="address">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" value="{{ old('city') }}"
                                        class="form-control @error('city') is-invalid @enderror" name="city"
                                        id="city">
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{ route('users.index') }}" class="btn btn-danger btn-back">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
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

            $('.role-id').select2({
                placeholder: 'Search...',
                width: "100%",
                allowClear: true,
            });

            $(`#salesman-code-1`).select2({
                placeholder: 'Select Sales...',
                width: "100%",
                allowClear: true,
                multiple: true,
                ajax: {
                    url: '{{ route('get.salesman') }}',
                    dataType: 'json',
                    type: 'POST',
                    delay: 0,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: `${item.code} - ${item.name}`,
                                    id: item.code,
                                }
                            })
                        };
                    },
                    cache: false
                }
            });

            $("#is_mng_sales").change(function(e) {
                e.preventDefault();
                isChecked = $(this).is(':checked');
                if (isChecked) {
                    $('.select-sales').show();
                    $(`#salesman-code-1`).select2({
                        placeholder: 'Select Sales...',
                        width: "100%",
                        allowClear: true,
                        multiple: true,
                        ajax: {
                            url: '{{ route('get.salesman') }}',
                            dataType: 'json',
                            type: 'POST',
                            delay: 0,
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            text: `${item.code} - ${item.name}`,
                                            id: item.code,
                                        }
                                    })
                                };
                            },
                            cache: false
                        }
                    });
                } else {
                    $('.select-sales').hide();
                    $(`.salesman-code`).empty();
                }
            });


            $("#is_sales").change(function(e) {
                e.preventDefault();
                isChecked = $(this).is(':checked');
                if (isChecked) {
                    $('.select-sales').show();
                    $(`.salesman-code`).removeAttr('multiple');
                    $(`#salesman-code-1`).select2({
                        placeholder: 'Select Sales...',
                        width: "100%",
                        allowClear: true,
                        ajax: {
                            url: '{{ route('get.salesman') }}',
                            dataType: 'json',
                            type: 'POST',
                            delay: 0,
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            text: `${item.code} - ${item.name}`,
                                            id: item.code,
                                        }
                                    })
                                };
                            },
                            cache: false
                        }
                    });
                } else {
                    $('.select-sales').hide();
                    $(`.salesman-code`).attr('multiple', true);
                    $(`.salesman-code`).empty();
                }
            });

        });
    </script>
@endsection
