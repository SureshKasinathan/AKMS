@extends('layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>

            <form class="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row match-height">
                    <!-- Profile Section Start -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">User Information</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="form-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role_id">Role</label>
                                                    <select name="role_id" id="role_id" class="select2 form-control">
                                                        <option value="">-- Select --</option>
                                                        @foreach($roles as $roles)
                                                        <option value="{{ $roles->id }}" {{ (old('role_id') == $roles->id) ? 'selected' : '' }}>{{ $roles->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('role_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">First Name</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="First Name" value="{{ old('firstname') }}">

                                                    @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastname">Last Name</label>
                                                    <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Last Name" value="{{ old('lastname') }}">

                                                    @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" autocomplete="off" value="{{ old('email') }}">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" autocomplete="off" value="{{ old('username') }}">

                                                    @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">{{ __('Password') }}</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cell">Cell</label>
                                                    <input type="text" name="cell" id="cell" class="form-control phone-inputmask @error('cell') is-invalid @enderror" placeholder="Cell"  value="{{ old('cell') }}">

                                                    @error('cell')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phonenumber">Phone</label>
                                                    <input type="text" name="phonenumber" id="phonenumber" class="form-control phone-inputmask @error('phonenumber') is-invalid @enderror" placeholder="Phone"  value="{{ old('phonenumber') }}">

                                                    @error('phonenumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="email_signature">Email Signature</label>
                                                <textarea class="form-control" id="email_signature" name="email_signature" rows="6" placeholder="Email Signature" spellcheck="false">{{ old('email_signature') }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="admin">Administrator</label>
                                                    <fieldset>
                                                        <div class="float-left">
                                                            <input type="checkbox" class="switch" {{ (old('admin') == 1) ? 'checked' : '' }} name="admin" id="admin" value="1" data-group-cls="btn-group-sm" />
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" name="city" id="city" class="form-control" placeholder="City">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">State</label>
                                                    <select name="state_code" id="state_code" class="select2 form-control">
                                                        <option value="">-- Select --</option>
                                                        @foreach(config('app.states') as $statecode=>$statename)
                                                        <option value="{{ $statecode }}">{{ $statename }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contry">Zip</label>
                                                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="reset" class="btn btn-warning mr-1"><i class="ft-x"></i> Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Profile Section End -->
        </div>
    </div>
</div>
</div>
@endsection