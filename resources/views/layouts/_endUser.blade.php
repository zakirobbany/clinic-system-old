<div class="profile">
    <div class="profile_pic">
        <img src="{{asset('images/img.jpg')}}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>

        @role('admin')
        <h2>
           {{ Auth::user()->dokter->display_name }}
        </h2>
        @endrole
        @role('dokter')
        <h2>
            {{ Auth::user()->dokter->display_name }}
        </h2>
        @endrole
        @role('registrasi')
        <h2>
            {{ Auth::user()->registrasi->display_name }}
        </h2>
        @endrole
    </div>
</div>