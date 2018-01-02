@foreach($registrasis as $registrasi)
    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
        <div class="well profile_view">
            <div class="col-sm-12">
                <h4 class="brief contact-div"><i>Perawat</i></h4>
                <div class="left col-xs-7">
                    <h2>{{ $registrasi->name }}</h2>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-building"></i><strong>Address:</strong>  {{$registrasi->alamat}} </li>
                        <li><i class="fa fa-phone"></i><strong>Phone:</strong> {{$registrasi->no_telepon}} </li>
                    </ul>
                    <p><strong>Perawat</strong></p>
                </div>
                <div class="right col-xs-5 text-center">
                    <img src="{{ asset('images/img.jpg') }}" alt="" class="img-circle img-responsive">
                </div>
            </div>
            <div class="col-xs-12 bottom text-center">
                <div class="col-xs-7 col-sm-10 col-md-9">
                    <a href="{{route('registrasi.edit', $registrasi->id)}}"><button type="button" class="btn btn-primary btn-xs">
                            <i class="fa fa-user"> </i> Edit Profile
                        </button>
                    </a>
                    <a href="{{route('registrasi.show', $registrasi->id)}}"><button type="button" class="btn btn-primary btn-xs">
                            <i class="fa fa-user"> </i> View Profile
                        </button>
                    </a>
                </div>
                <div class="col-xs-5 col-md-3 col-sm-2">
                    {!! Form::model($registrasi, ['route'=>['registrasi.destroy', $registrasi], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                    {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach