@extends('layouts.app')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Companies</li>
                    </ol>
                </div>
            </div>
            <!-- Basic Tables start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Companies</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a href="{{ route('companies.create') }}"><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-primary"><i class="fa fa-plus"></i> Create</span></a></li>
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="company_list">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Cell</th>
                                                <th># Users</th>
                                                <th># Loans</th>
                                                <th># Contacts</th>
                                                <th>Register Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companies as $companies)
                                            <tr id="company_{{ $companies->id }}">
                                                <td class="company_no">{{ $loop->iteration }}</td>
                                                <td nowrap>
                                                    <div class="row">
                                                        <div class="media-left pr-1">
                                                            <span class="avatar avatar-md avatar-online">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/LendStacks/company_logo.png" alt="Generic placeholder image">
                                                            </span>
                                                        </div>
                                                        <div class="media-left">{{ $companies->name }}</div>
                                                    </div>
                                                </td>
                                                <td nowrap>{{ $companies->email }}</td>
                                                <td nowrap>{{ $companies->phonenumber }}</td>
                                                <td nowrap>{{ $companies->cell }}</td>
                                                <td nowrap>0</td>
                                                <td nowrap>0</td>
                                                <td nowrap>0</td>
                                                <td nowrap>{{ date('m-d-Y H:i:s a', strtotime($companies->created_at)) }}</td>
                                                <td nowrap>
                                                    <a href='companies/{{ $companies->id }}/edit'><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-warning">Edit</span></a>

                                                    <a onclick="updateTheRequestedResources(
                                                        'company',
                                                        '{{ $companies->id }}',
                                                        'companies/{{ $companies->id }}',
                                                        '{{ csrf_token() }}',
                                                        '{{ $companies->name }}',
                                                        '{{ $companies->active }}'
                                                        );">
                                                        <i class="ft-user-plue"></i><span class="badge badge badge-pill
                                                            {{ ($companies->active == 1) ? 'badge-success': 'badge-danger' }}
                                                            " id="company_status_{{ $companies->id }}">{{ ($companies->active == 1) ? 'Active': 'Deactive' }}</span></a>

                                                    &nbsp;<a onclick="deleteTheRequestedResources('company', '{{ $companies->id }}', 'companies/{{ $companies->id }}', '{{ csrf_token() }}', '{{ $companies->name }}');"><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-danger">Delete</span></a>
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