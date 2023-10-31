<div class="d-flex p-2 justify-content-between" style="border-radius: 0px 0px 15px 15px;border:1px solid black;background-image: linear-gradient(to bottom, #EADBC8, #DAC0A3);">
    <div class="d-flex">
        <div id="borderch">
            <img src="/img/person.jpg" style="width:58px; height:58px;border-radius: 30px;object-fit: cover;" alt="">
        </div>
        <div style="font-size:23px; margin-left:10px;">
            <p style="font-weight: bold">{{__('loc.hi')}}, {{$nama_user}}!</p>
            <div style="border:1px solid black" id="separator"></div>
            <p style="font-size:18px;">{{$jabatan}} KEP</p>
        </div>
    </div>
    <div style="display: flex; float-right">
        {{-- language btn --}}
        <div class="logout-container">
            <form action="{{route('loc')}}" method="POST">
            @csrf
            <button type="submit"><i  class="fa-solid fa-language"></i></button>
            </form>
        </div>
        {{-- end language btn --}}

        {{-- logout btn --}}
        <div class="logout-container">
            <form action="{{route('logout')}}" method="POST">
            @csrf
            <button><i  class="fa-solid fa-arrow-right-from-bracket"></i></button>
            </form>
        </div>
        {{-- end logout btn --}}

        <div id="home" class="logout-container">
            <i  class="fa-solid fa-house"></i>
        </div>
        <div style="display: flex;align-items:center;margin-left:10px;">
           <img src="/img/logo.png" alt="" style="width:50px;height:50px;">
        </div>
    {{-- <img src="/img/burger-bar.png" alt="" style="width:50px; heght:50px;"> --}}
    </div>
</div>