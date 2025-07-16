@extends('admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0"></h2>
        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="ti ti-user-plus"></i> Create New User</h5>
            </div>
            <div class="card-body">
            

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><strong>First Name</strong><span class="text-danger">*</span></label>
                        <input type="text" name="first_name" placeholder="Name" class="form-control"  value="{{ old('first_name') }}" required>
                        @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                      <div class="mb-3">
                        <label class="form-label"><strong>Middle Name</strong></label>
                        <input type="text" name="middle_name" placeholder="Middle Name" class="form-control" value="{{ old('middle_name') }}">
                        @error('middle_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                      <div class="mb-3">
                        <label class="form-label"><strong> Last Name</strong><span class="text-danger">*</span></label>
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{ old('last_name') }}" required>
                         @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                      <div class="mb-3">
                        <label class="form-label"><strong>Mobile Number</strong><span class="text-danger">*</span></label>
                        <input type="text" name="user_mobile" placeholder="Mobile Number" class="form-control" value="{{ old('user_mobile') }}" required>
                        @error('user_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Email</strong><span class="text-danger">*</span></label>
                        <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required>
                         @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Password</strong><span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            <button class="btn btn-outline-primary toggle-password" type="button" data-target="password">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                         @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Confirm Password</strong><span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                            <button class="btn btn-outline-primary toggle-password" type="button" data-target="confirm-password">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Usertype</strong><span class="text-danger">*</span></label>
                        <select name="user_type" class="form-control" required>
                            <option value="" disabled selected>Select Usertype</option>
                            @foreach ($usertypes as $value => $label)
                                <option value="{{ $value }}" {{ old('user_type') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                         @error('user_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong><span class="text-danger">*</span></label>
                        <select name="user_status" class="form-control" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                           @error('user_status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script data-cfasync="false">
   jQuery(function($) {
        $('.toggle-password').on('click', function(e) {
            e.preventDefault();
            var inputId = $(this).data('target');
            var $input = $('#' + inputId);
            var $icon = $(this).find('i');
            if ($input.length) {
                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $input.attr('type', 'password');
                    $icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            }
        });
    });
</script>
@endpush