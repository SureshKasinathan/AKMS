@extends('layouts.app')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </div>
            </div>

            <!-- Basic Tables start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Users</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a href="{{ route('users.create') }}"><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-primary"><i class="fa fa-plus"></i> Create</span></a></li>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Phone</th>
                                                <th>Cell</th>
                                                <th>Register Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $users)
                                            <tr id="user_{{ $users->id }}">
                                                <td class="user_no">{{ $loop->iteration }}</td>
                                                <td nowrap>
                                                    <div class="row">
                                                        <div class="media-left pr-1">
                                                            <span class="avatar avatar-md avatar-online">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-2.png" alt="Generic placeholder image">
                                                            </span>
                                                        </div>
                                                        <div class="media-left">{{ $users->firstname . " " . $users->lastname }}</div>
                                                    </div>
                                                </td>
                                                <td nowrap>{{ $users->email }}</td>
                                                <td nowrap>{{ $users->role }}</td>
                                                <td nowrap>{{ $users->phonenumber }}</td>
                                                <td nowrap>{{ $users->cell }}</td>
                                                <td nowrap>{{ date('m-d-Y H:i:s a', strtotime($users->created_at)) }}</td>
                                                <td nowrap>
                                                    <a href='users/{{ $users->id }}/edit'><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-warning">Edit</span></a>

                                                    <a onclick="updateTheRequestedResources(
                                                        'user',
                                                        '{{ $users->id }}',
                                                        'users/{{ $users->id }}',
                                                        '{{ csrf_token() }}',
                                                        '{{ $users->name }}',
                                                        '{{ $users->active }}'
                                                        );">
                                                        <i class="ft-user-plue"></i><span class="badge badge badge-pill
                                                            {{ ($users->active == 1) ? 'badge-success': 'badge-danger' }}
                                                            " id="user_status_{{ $users->id }}">{{ ($users->active == 1) ? 'Active': 'Deactive' }}</span></a>
                                                    @if ($users->id != Auth::user()->id)
                                                    &nbsp;<a onclick="deleteTheRequestedResources('user', '{{ $users->id }}', 'users/{{ $users->id }}', '{{ csrf_token() }}', '{{ $users->name }}');"><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-danger">Delete</span></a>
                                                    @endif
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
            </div>
            <!-- Basic Tables end -->
        </div>
    </div>
</div>
@endsection