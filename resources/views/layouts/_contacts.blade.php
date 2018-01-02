@foreach($karyawans as $karyawan)
    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
        <div class="well profile_view">
            <div class="col-sm-12">
                <h4 class="brief contact-div"><i>Digital Strategist</i></h4>
                <div class="left col-xs-7">
                    <h2>{{ $karyawan->name }}</h2>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-building"></i><strong>Address:</strong>  {{$karyawan->alamat}} </li>
                        <li><i class="fa fa-phone"></i><strong>Phone:</strong> {{$karyawan->no_telepon}} </li>
                    </ul>
                    <p><strong>Spesialisasi: </strong> Web Designer</p>
                </div>
                <div class="right col-xs-5 text-center">
                    <img src="{{ asset('images/img.jpg') }}" alt="" class="img-circle img-responsive">
                </div>
            </div>
            <div class="col-xs-12 bottom text-center">
                <div class="col-xs-8">
                    <a href="#"><button type="button" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"> </i> Edit Profile
                        </button>
                    </a>
                    <a href="{{route('karyawan.show', $karyawan->id)}}"><button type="button" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"> </i> View Profile
                        </button>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 emphasis">

                </div>
            </div>
        </div>
    </div>
@endforeach