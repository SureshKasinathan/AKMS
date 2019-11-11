@extends('layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>

            <div class="row match-height">
                <!-- Profile Section Start -->
                <div class="col-md-12">
                    <div class="card">
                        <form class="form" method="POST" action="companies/{{ $company->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Company Information</h4>
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
                                                    <label for="name">Company Name</label>
                                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Company Name" value="{{ $company->name }}" required>

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" autocomplete="off" value="{{ $company->email }}" required>

                                                    @error('email')
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
                                                    <label for="phonenumber">Phone</label>
                                                    <input type="text" name="phonenumber" id="phonenumber" class="form-control phone-inputmask @error('phonenumber') is-invalid @enderror" placeholder="Phone" value="{{ $company->phonenumber }}" required>

                                                    @error('phonenumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cell">Cell</label>
                                                    <input type="text" name="cell" id="cell" class="form-control phone-inputmask" placeholder="Cell" value="{{ $company->cell }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ $company->address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ $company->city }}">
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
                                                        <option value="{{ $statecode }}" {{ ($company->state_code == $statecode) ? 'Selected' : '' }}>{{ $statename }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contry">Zip</label>
                                                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" value="{{ $company->zip }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="website">Website</label>
                                                    <input type="text" name="website" id="website" class="form-control" placeholder="Website" value="{{ $company->website }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nmlsid">NMLS ID#</label>
                                                    <input type="text" name="nmlsid" id="nmlsid" class="form-control" placeholder="NMLS ID#" value="{{ $company->nmlsid }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Profile Section End -->
            </div>
        </div>
    </div>
</div>
@endsection