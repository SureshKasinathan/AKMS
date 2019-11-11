@extends('layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Group</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>

            <form class="form" method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Profile Section Start -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Group Information</h4>
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
                                                        <label for="name">Group Name</label>
                                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="company_id">Company</label>
                                                        <select name="company_id" id="company_id" class="select2 form-control">
                                                            <option value="">-- Select --</option>
                                                            @foreach($companies as $companies)
                                                            <option value="{{ $companies->id }}">{{ $companies->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('company_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
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

                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Users</h4>
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
                                        <table class="table" id="user_list">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><input type='checkbox' name="selectall" id="selectall"></th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $users)
                                                <tr id="user_{{ $users->id }}">
                                                    <td class="user_no">{{ $loop->iteration }}</td>
                                                    <td><input type='checkbox' name="selectall" id="selectall"></td>
                                                    <td nowrap>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="avatar avatar-md avatar-online">
                                                                    <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-2.png" alt="Generic placeholder image">
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6">{{ $users->firstname . " " . $users->lastname }}</div>
                                                        </div>
                                                    </td>
                                                    <td nowrap>{{ $users->email }}</td>
                                                    <td nowrap>{{ $users->phonenumber }}</td>
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