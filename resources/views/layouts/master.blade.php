<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

<script defer src="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></script>
<script defer src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script defer src="https://kit.fontawesome.com/30ad546f67.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/galeria.css">
    <link rel="icon" type="imagem/png" href="assets/ico/r.png" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/cadastro.css')}}">
    <link rel="stylesheet" href="{{url('css/contato.css')}}">
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <link rel="stylesheet" href="{{url('css/landing.css')}}">
    <link rel="stylesheet" href="{{url('css/galeria.css')}}">
    <script defer src="{{url('js/app.js')}}"></script>
</head>

{{-- Inicio da validação do Header --}}

@guest {{-- Não logado / Usuário geral --}}
<header>
    <nav class=" navNova navbar navbar-expand-lg navbar-light bg-light">
        <a class="marca navbar-brand" href="/">REACH ME OUT<span class="dot-color">.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="justify-content-between collapse navbar-collapse" id="navbarSupportedContent">
            <ul class=" navDireita navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="marcas">Marcas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="influenciadores">Influenciadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target=".bd-login-modal-lg">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@endguest
{{-- Fim do Não Logado / Usuário Geral --}}

@auth {{-- Inicio da validação de tipo de cliente --}}
@if(Auth::user()->tipo_cliente == 'influencer') {{-- Cliente Influencer logado --}}
<header>
    <nav class="navbar navbar-expand-md navbar-light align-items-center m-0 text-white">
        <p class="col-8 col-md-4 m-0">
            Olá {{ Auth::user()->nome }}</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navInterna" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <section class="collapse navbar-collapse col-md-8" id="navInterna">
        <ul class="navbar-nav text-center">
            <li><a class="menuLogado" href="">Mensagens</a></li>
            <li><a class="menuLogado" href="">Suporte</a></li>
            <li><a class="menuLogado" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form></li>
        </ul>
        </section>
    </nav>
</header>


{{-- Fim do Header do cliente Influencer --}}

@elseif(Auth::user()->tipo_cliente == 'marca') {{-- Inicio do header do cliente Marca --}}
 <!-- MENU DE NAVEGAÇÃO -->
 <header>
    <nav class="navbar navbar-expand-md navbar-light align-items-center m-0 text-white">
        <p class="col-8 col-md-4 m-0">
            Olá {{ Auth::user()->nome }}</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navInterna" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <section class="collapse navbar-collapse col-md-8" id="navInterna">
        <ul class="navbar-nav text-center">
            <li><a class="menuLogado" href="">Mensagens</i></a></li>
            <li><a class="menuLogado" href="">Suporte</a></li>
            <li><a class="menuLogado" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form></li>
        </ul>
        </section>
    </nav>
</header>
@endif
{{-- Fim do Header do cliente marca --}}

@endauth{{-- Fim da validação de tipo de cliente --}}

<main>
    @yield('content')
    @yield('modais')
</main>

{{-- Inicio do Footer --}}
<footer class="page-footer font-small pt-2">

    <!-- Footer Elements -->
    <div class="container">

        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center">
            <li class="list-inline-item">
                <a class="btn-floating btn-fb mx-1">
                    <i class="fab fa-facebook-square"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-tw mx-1">
                    <i class="fab fa-twitter-square"> </i>
                </a><!-- Footer -->
            </li><!-- Footer -->
            <li class="list-inline-item">
                <a class="btn-floating btn-gplus mx-1">
                    <i class="fab fa-google-plus-square"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-li mx-1">
                    <i class="fab fa-instagram"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-dribbble mx-1">
                    <i class="fab fa-dribbble-square"> </i>
                </a>
            </li>
        </ul>
        <!-- Social buttons -->

    </div>
    <!-- Footer Elements -->
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 textFooter">
                <h5 class="text-uppercase">REACH ME OUT</a><span class="dot-color">.</h5>
            </div>
        </div>

        <div class="footer-copyright text-center py-3">© 2019 Copyright:
            <a href=""> reachmeout.com</a>
        </div>

</footer>
{{-- Fim do Footer --}}
