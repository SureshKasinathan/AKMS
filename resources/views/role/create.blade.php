@extends('layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>

            <form class="form" method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Profile Section Start -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Role Information</h4>
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Role Name</label>
                                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="4" cols="10" placeholder="Email Signature" spellcheck="false">{{ old('email_signature') }}</textarea>
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

                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Capabilities</h4>
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
                                        <div class="table-responsive">
                                            <table class="table" id="role_list">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Feature</th>
                                                        <th>View (Own)</th>
                                                        <th>View (Global)</th>
                                                        <th>Create</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permissions as $permissions)
                                                    <tr id="role_{{ $permissions->id }}">
                                                        <td class="role_no">{{ $loop->iteration }}</td>
                                                        <td nowrap>{{ $permissions->name }}</td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[{{ $permissions->id }}][view_own]" id="view_own_{{ $permissions->id }}" value="{{ $permissions->id }}" {{ ($permissions->view_own) ? 'checked' : '' }} checked>
                                                                <label class="custom-control-label" for="view_own_{{ $permissions->id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[{{ $permissions->id }}][view_global]" id="view_global_{{ $permissions->id }}" value="{{ $permissions->id }}" {{ ($permissions->view_global) ? 'checked' : '' }} checked>
                                                                <label class="custom-control-label" for="view_global_{{ $permissions->id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[{{ $permissions->id }}][create]" id="create_{{ $permissions->id }}" value="{{ $permissions->id }}" {{ ($permissions->create) ? 'checked' : '' }} checked>
                                                                <label class="custom-control-label" for="create_{{ $permissions->id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[{{ $permissions->id }}][edit]" id="edit_{{ $permissions->id }}" value="{{ $permissions->id }}" {{ ($permissions->edit) ? 'checked' : '' }} checked>
                                                                <label class="custom-control-label" for="edit_{{ $permissions->id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[{{ $permissions->id }}][delete]" id="delete_{{ $permissions->id }}" value="{{ $permissions->id }}" {{ ($permissions->delete) ? 'checked' : '' }} checked>
                                                                <label class="custom-control-label" for="delete_{{ $permissions->id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Profile Section End -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection