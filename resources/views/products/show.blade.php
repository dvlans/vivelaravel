@extends('layouts.app')

@section('tittle', 'App Shop | Dashboard')

@section('body-class', 'profile-page')

@section('styles')
    <style>
        .alert {
           width:700px;    
        }
    </style>
@endsection

@section('content')



<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">

            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{ $product->featured_image_url }}" alt="Circle Image" class="img-circle img-responsive img-raised">
                    </div>
                    <div class="name">
                        <h3 class="title">{{ $product->name }}</h3>
                        <h6>{{ $product->category->name }}</h6>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger center-block">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error}}<a href="{{ route('login') }}" class="alert-link"> <br>Iniciar sesión</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('notification'))
                        <div class="alert alert-success center-block" role="alert">
                            <div class="container-fluid">
                              <div class="alert-icon">
                                <i class="material-icons">check</i>
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                              </button>
                              <b>{{ session('notificationHead') }}</b> {{ session('notification') }} 
                                <a href="{{ url('/home') }}" class="alert-link"> <br>Ver carrito de compras</a>
                            </div>
                        </div>
                    @endif
                    @if (session('notificationFail'))
                        <div class="alert alert-danger center-block" role="alert">
                            <div class="container-fluid">
                              <div class="alert-icon">
                                <i class="material-icons">error_outline</i>
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                              </button>
                              <b>{{ session('notificationHead') }}</b> {{ session('notificationFail') }} 
                                <a href="{{ route('login') }}" class="alert-link"> <br>Iniciar sesión</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="description text-center">
                <p>{{ $product->long_description }}</p>
            </div>
            <div class="text-center">
                <button class="btn btn-info btn-round" data-toggle="modal" data-target="#modalAddToCart">
                    <i class="material-icons">add</i> Añadir al carrito de compras
                </button>    
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="profile-tabs">
                        <div class="nav-align-center">


                            <div class="tab-content gallery">
                                <div class="tab-pane active" id="studio">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @foreach ($imagesLeft as $image)
                                            <img src="{{ $image->url }}" class="img-rounded" />
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            @foreach ($imagesRight as $image)
                                            <img src="{{ $image->url }}" class="img-rounded" />
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Profile Tabs -->
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal Core -->
<div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Seleccione la cantidad que desea agregar</h4>
      </div>
      <form method="post" action="{{ url('/cart') }}">
        {{ csrf_field() }}
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="modal-body">
            <input type="number" name="quantity" value="1" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info btn-simple">Añadir al carrito</button>
        </div>    
      </form>
      
    </div>
  </div>
</div>


@include('includes.footer')
@endsection


