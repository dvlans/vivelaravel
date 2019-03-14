@extends('layouts.app')

@section('body-class', 'landing-page')

@section('styles')
    <style>
        .team .row .col-md-4{
            margin-bottom: 5em;
        }
        .row {
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display:         flex;
          flex-wrap: wrap;
        }
        .row > [class*='col-'] {
          display: flex;
          flex-direction: column;
        }
        .tt-query {
          -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
             -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
          color: #999
        }

        .tt-menu {    /* used to be tt-dropdown-menu in older versions */
          width: 222px;
          margin-top: 4px;
          padding: 4px 0;
          background-color: #fff;
          border: 1px solid #ccc;
          border: 1px solid rgba(0, 0, 0, 0.2);
          -webkit-border-radius: 4px;
             -moz-border-radius: 4px;
                  border-radius: 4px;
          -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
             -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                  box-shadow: 0 5px 10px rgba(0,0,0,.2);
        }

        .tt-suggestion {
          padding: 3px 20px;
          line-height: 24px;
        }

        .tt-suggestion.tt-cursor,.tt-suggestion:hover {
          color: #fff;
          background-color: #55C90B;

        }

        .tt-suggestion p {
          margin: 0;
        }
    </style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/img/fondoverde.png') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="title">Bienvenido a Vive Vivero.</h1>
                <h4>¿Quieres saber como trabajamos?</h4>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-success btn-raised btn-lg">
                    <i class="fa fa-play"></i> Mira acá
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">#ViveConPlantas</h2>
                    <h5 class="description">Poblar las viviendas de nuestros clientes con nuestros mejores arreglos, botánica, plantas de interiores, maceteros con diseños únicos.</h5>
                </div>
            </div>

            <div class="features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-primary">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <h4 class="info-title">Confiabilidad</h4>
                            <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">spa</i>
                            </div>
                            <h4 class="info-title">Somos plantas</h4>
                            <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">fingerprint</i>
                            </div>
                            <h4 class="info-title">Seguridad y cuidado</h4>
                            <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section text-center">
            <h2 class="title">Visita nuestras categorías</h2>

            <form class="form-inline" action="{{ url('/search') }}" method="get">
                <input type="text" placeholder="¿Qué articulo buscas?" class="form-control" name="query" id="search">
                <button class="btn btn-primary btn-fab btn-fab-mini btn-round" type="submit">
                    <i class="material-icons">search</i>
                </button>
            </form>
            <div class="team">
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="team-player">
                            <a href="{{ url('/categories/'.$category->id) }}"><img src="{{ $category->featured_image_url }}" alt="Imagen representativa de la categoria 
                                {{ $category->name }}" class="img-raised img-circle"></a>
                            <h4 class="title">
                                <a href="{{ url('/categories/'.$category->id) }}">{{ $category->name }}</a>
                            </h4>
                            <p class="description">{{ $category->description }}</p>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>


        <div class="section landing-section">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">Contáctanos</h2>
                    <h4 class="text-center description">Escribenos tus ideas, proyectos, consejos.</h4>

                    <form class="contact-form" action="{{ url('/messageClient') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tu nombre</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tu correo</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">Tu mensaje</label>
                            <textarea class="form-control" name="message" rows="4"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <button type="submit"class="btn btn-success btn-raised">
                                    Enviar mensaje
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@include('includes.footer')
@endsection

@section('scripts')
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script>
        $(function (){
            var products = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              // `states` is an array of state names defined in "The Basics"
              prefetch: '{{ url("/products/json") }}'
            });           

            //inicializar typeahead sobre nuestro input de búsqueda
            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },{
                name: 'products',
                source: products
            });
        });
    </script>
@endsection




