@extends('layouts.app')

@section('tittle', 'Resultados de la búsqueda')

@section('body-class', 'profile-page')

@section('styles')
    <style>
        .profile-page .profile img {
            max-width: 160px;
            margin: -80px auto 0;
        }
        .team{
            padding-bottom: 50px;
        }
        .team .row .col-md-4{
            margin-bottom: 5em;
        }
        .row {
          
          
          flex-wrap: wrap;
        }
        .row > [class*='col-'] {
          display: flex;
          flex-direction: column;
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
                        <img src="/img/search.png" alt="Imagen de una lupa representa la busqueda" class="img-circle img-responsive img-raised">
                    </div>
                    <div class="name">
                        <h3 class="title">Resultados de la búsqueda</h3>
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
                <p>Se encontraron {{ $products->count() }} para la búsqueda de "{{ $query }}"</p>
            </div>
            
            <div class="team text-center">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="team-player">
                            <a href="{{ url('/products/'.$product->id) }}"><img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised img-circle"></a>
                            <h4 class="title">
                                <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}</a>
                                
                                
                            </h4>
                            <p class="description">{{ $product->description }}</p>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    {{ $products->links()}}
                </div>
            </div>

        </div>
    </div>
</div>





@include('includes.footer')
@endsection


