@foreach($dokters as $dokter)
    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
        <div class="well profile_view">
            <div class="col-sm-12">
                <h4 class="brief contact-div"><i>Dokter {{ $dokter->spesialis->nama_spesialis }}</i></h4>
                <div class="left col-xs-7">
                    <h2>{{ $dokter->name }}</h2>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-building"></i><strong>Address:</strong>  {{$dokter->alamat}} </li>
                        <li><i class="fa fa-phone"></i><strong>Phone:</strong> {{$dokter->no_telepon}} </li>
                    </ul>
                    <p><strong>Spesialis: </strong>{{ $dokter->spesialis->nama_spesialis }}</p>
                </div>
                <div class="right col-xs-5 text-center">
                    <img src="{{ asset('images/img.jpg') }}" alt="" class="img-circle img-responsive">
                </div>
            </div>
            <div class="col-xs-12 bottom text-center">
                <div class="col-xs-7 col-sm-10 col-md-9">
                    <a href="{{route('dokter.edit', $dokter->id)}}"><button type="button" class="btn btn-primary btn-xs">
                            <i class="fa fa-user"> </i> Edit Profile
                        </button>
                    </a>
                    <a href="{{route('dokter.show', $dokter->id)}}"><button type="button" class="btn btn-primary btn-xs">
                            <i class="fa fa-user"> </i> View Profile
                        </button>
                    </a>
                </div>
                <div class="col-xs-5 col-md-3 col-sm-2">
                        {!! Form::model($dokters, ['route'=>['dokter.destroy', $dokter], 'method'=>'delete', 'class'=>'form-inline', 'id'=>'form-delete-'.$dokter->id]) !!}
                        {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach