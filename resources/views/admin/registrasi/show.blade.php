@extends('layouts.layout')

@section('content')
    <div class="right_col" role="main" style="margin-left: -15px">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>User Profile</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $perawat->display_name }} <small>Perawat</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="{{asset('images/picture.jpg')}}" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <h3>{{ $perawat->name }}</h3>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $perawat->alamat }}
                                    </li>

                                    <li>
                                        <i class="fa fa-stethoscope user-profile-icon"></i>Perawat
                                    </li>
                                    <li>
                                        <i class="fa fa-male user-profile-icon"></i> {{ $perawat->tanggal_lahir }}
                                    </li>
                                    <li>
                                        <i class="fa fa-tablet user-profile-icon"></i> {{ $perawat->no_telepon }}
                                    </li>
                                    <li>
                                        <i class="fa fa-at user-profile-icon"></i> {{ $perawat->email }}
                                    </li>

                                </ul>

                                <a class="btn btn-success" href="{{ route('perawat-registrasi.edit', $perawat->id) }}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                <br />

                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="profile_title">
                                    <div class="col-md-6">
                                        <h2>User Activity Report</h2>
                                        <ul class="list-unstyled user_data">
                                            <li>
                                                <p>Absensi</p>
                                                <span>{{ number_format($absensiPercentage, 2) }}%</span>
                                                <div class="progress progress_sm">
                                                    <div class="progress-bar {{ $absensiStatus }}" role="progressbar" data-transitiongoal="{{ $absensiPercentage }}"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
