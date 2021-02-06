@extends('../templates/admin')

@section('title', 'Guide')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/guide') }}">Guide</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-md-9 col-lg-6 white-wrapper radius-admin mb-4 mt-5 mt--5">
                <div class="guide-user position-relative py-5 shadow px-2 radius-admin">
                    <div class="header text-center py-3 px-3 position-absolute top-absolute bg-dark full-width text-white radius-admin">
                        <img src="{{asset('img/icon.png')}}" width="55" class="rounded-circle p-2" style="background-color: rgb(248, 248, 248)">
                    </div>
                    <div class="body pt-5 pb-2 pl-1 pr-4 text-justify">
                        <h1 class="title-admin text-center mt-2">User Guide</h1>
                        <ol class="mt-3 mb-2">
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam itaque nihil, minus quo quos voluptate, veritatis, perferendis iure iste repellendus voluptatibus asperiores? Repudiandae omnis voluptatem alias iusto vitae? Commodi, sint.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam itaque nihil, minus quo quos voluptate, veritatis, perferendis iure iste repellendus voluptatibus asperiores? Repudiandae omnis voluptatem alias iusto vitae? Commodi, sint.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam itaque nihil, minus quo quos voluptate, veritatis, perferendis iure iste repellendus voluptatibus asperiores? Repudiandae omnis voluptatem alias iusto vitae? Commodi, sint.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam itaque nihil, minus quo quos voluptate, veritatis, perferendis iure iste repellendus voluptatibus asperiores? Repudiandae omnis voluptatem alias iusto vitae? Commodi, sint.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam itaque nihil, minus quo quos voluptate, veritatis, perferendis iure iste repellendus voluptatibus asperiores? Repudiandae omnis voluptatem alias iusto vitae? Commodi, sint.</li>
                        </ol>
                    </div>
                    <div class="footer position-absolute bottom-absolute bg-dark full-width radius-admin p-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection