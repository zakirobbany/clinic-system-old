@role('dokter')
<td>
    @if(isset($k->rekamMedis->pasien_poli_id))
        <a href="{{ route('dokter-kunjunganPoli.show', $k->id ) }}"
           class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
            Rekam Medis
        </a>
    @endif
    @if(isset($k->rujukan->pasien_poli_id))
        <a href="{{ route('dokter.kunjungan.kunjunganRujukan', $k->id ) }}"
           class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
            Rujukan
        </a>
    @endif
</td>
@endrole
@role('registrasi')
<td>
    @if(isset($k->rekamMedis->pasien_poli_id))
        <a href="{{ route('perawat-kunjunganPoli.show', $k->id ) }}"
           class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
            Rekam Medis
        </a>
    @endif
    @if(isset($k->rujukan->pasien_poli_id))
        <a href="{{ route('perawat.kunjungan.kunjunganRujukan', $k->id ) }}"
           class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
            Rujukan
        </a>
    @endif
</td>
@endrole
<td>
    @role('registrasi')
    @if(!$k->rekamMedis['pasien_poli_id'] == $k->id)
        <a href="{{ route('perawat.rekammedis.create', $k->id) }}"
           class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i>
            Rekam Medis
        </a>
    @endif
    <a href="{{ route('perawat.rujukan.create', $k->id) }}"
       class="btn btn-xs btn-warning"><i class="fa fa-building-o"></i>
        Rujuk
    </a>


    <a href="{{ route('perawat-kunjunganPoli.edit', $k->id) }}"
       class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
        Edit
    </a>
    {!! Form::model($k, ['route'=>['perawat-kunjunganPoli.destroy', $k], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
    {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
    {!! Form::close() !!}

    @endrole
    @role('dokter')
    @if(!$k->rekamMedis['pasien_poli_id'] == $k->id)
        <a href="{{ route('dokter.rekammedis.create', $k->id) }}"
           class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i>
            Rekam Medis
        </a>
    @endif
    <a href="{{ route('dokter.rujukan.create', $k->id) }}"
       class="btn btn-xs btn-warning"><i class="fa fa-building-o"></i>
        Rujuk
    </a>
    @endrole
</td>