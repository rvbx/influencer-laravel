@extends('layouts.master')
@extends('modais')

@section('content')
@auth

{{-- Inicio de validação de tipo de cliente --}}

@if(Auth::user()->tipo_cliente == 'influencer')
<!-- Conteúdo da tela de trabalho do INFLUENCER -->
<div class="container-fluid mt-3">
    <div class="row">

        <div class="col-2 filtro-content">
            <p>Navegue por Filtro</p>
            @foreach ($categorias as $categoria)
            <a href="#">{{($categoria->categoria)}}</a>
            @endforeach
        </div>

        <div class="col-10">
            <div class="banner-content-influencer">
            </div>

            <section class="mt-3">
                <h2 class="marca-interna">Lista de Campanhas</h2>
                @foreach ($campanhas as $campanha)
                <div class="card mb-3 borda-interna" style="max-width: 900px;">
                    <div class="row no-gutters">
                        <div class="col-md-5 d-flex align-items-center">
                            <img class="imagem" src="{{url($campanha->imagem)}}" alt="">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <td scope="row">{{$campanha->titulo}}</td>
                                <hr>
                                <p class="card-text">
                                    <td scope="row">{{$campanha->descricao}}</td>
                                </p>
                                <hr>
                                <div class="d-flex flex-column">
                                    <div class="flex-column">
                                        <p>Categoria:
                                            <td scope="row">{{$campanha->categoria->categoria}}</td>
                                        </p>
                                        <hr>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-column mr-5">
                                            <p class="card-text"> Data inicial:
                                                <td scope="row">{{date('d-m-Y', strtotime($campanha->inicio))}}</td>
                                            </p>
                                        </div>
                                        <div class="flex-column">
                                            <p class="card-text"> Data final:
                                                <td scope="row">{{date('d-m-Y', strtotime($campanha->fim))}}</td>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-left mt-3">
                                        <button class="card-button">Participar da Campanha</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
        </section>
    </div>
</div>



{{-- </header> --}}


{{------------------------------------------- Fim do INFLUENCER ----------------------------------}}



@elseif(Auth::user()->tipo_cliente == 'marca')
<!-- Conteudo da tela de trabalho da MARCA -->

<div class="container-fluid mt-3">

    <!-- Modal marca -->




    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success')}}</p>
    </div>
    @endif


    <div class="row">
        <div class="col-2 filtro-content">
            <p>Navegue por Filtro</p>
            @foreach ($categorias as $categoria)
            <a href="#">{{($categoria->categoria)}}</a>
            @endforeach
        </div>


        <div class="col-10">
            <div class="banner-content">
                <button class="mb-5 button-content col-3 d-flex justify-content-center" type="button"
                    data-toggle="modal" data-target=".modalInfo">
                    Criar Campanha
                </button>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="marca-interna">Campanhas em Andamento</h2>
                    @foreach ($campanhas as $campanha)
                    @if($campanha->id_marca == Auth::user()->id)
                    <div class="card mb-3 borda-interna" style="max-width: 900px;">
                        <div class="row no-gutters">
                            <div class="col-md-5 d-flex align-items-center">
                                <img class="imagem" src="{{url($campanha->imagem)}}" alt="">
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">

                                    <td scope="row">{{$campanha->titulo}}</td>
                                    <hr>
                                    <p class="card-text">
                                        <td scope="row">{{$campanha->descricao}}</td>
                                    </p>
                                    <hr>
                                    <div class="d-flex flex-column">
                                        <div class="flex-column">
                                            <p>Categoria:
                                                <td scope="row">{{$campanha->categoria->categoria}}</td>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-column mr-5">
                                                <p class="card-text"> Data inicial:
                                                    <td scope="row">{{date('d-m-Y', strtotime($campanha->inicio))}}</td>
                                                </p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="card-text"> Data final:
                                                    <td scope="row">{{date('d-m-Y', strtotime($campanha->fim))}}</td>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button class="mb-3 mt-3 mr-5 button-content-marca" type="button"
                                                data-toggle="modal"
                                                data-target="#editModal{{$campanha->id}}">Editar</button>
                                            <button class="mb-3 mt-3 button-content-marca" type="button"
                                                data-toggle="modal" data-target="#deleteModal{{$campanha->id}}
                                                ">Excluir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=" modal fade" id="editModal{{$campanha->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content modal-editar-campanha">
                                <section class="d-flex flex-row align-items-center justify-content-center">
                                    <div class="col-6">
                                        <p>Alterar campanha</p>
                                        <img class="img-fluid" src="{{url($campanha->imagem)}}" alt="">
                                    </div>
                                    <div class="col-6">
                                        <form method="POST" action="/home/{{$campanha->id}}"
                                            enctype="multipart/form-data" id="editForm">

                                            {{ csrf_field() }}
                                            {{method_field('PUT')}}

                                            <input type="hidden" value="{{$campanha->imagem}}" name="campanhaImagem">
                                            <div class="form-group campanha-content campanha-top">
                                                <label for="titulo">Título da Campanha</label>
                                                <input type="text" name="titulo" value="{{$campanha->titulo}}"
                                                    class="form-control" id="titulo">
                                            </div>

                                            <div class="form-group campanha-content">
                                                <label for="descricao">descriçao</label>
                                                <input type="text" name="descricao" value="{{$campanha->descricao}}"
                                                    class="form-control" id="descricao">
                                            </div>

                                            <div class="form-group campanha-content">
                                                <label for="imagem">Imagem</label>
                                                <input type="file" name="imagem" class="form-control" id="imagem">
                                            </div>

                                            <div class="form-group campanha-content">
                                                <label for="categoria">Alterar categoria?</label>
                                                <select name="categoria" class="form-control" id="categoria">
                                                    <option value="{{$campanha->categoria->id}}">
                                                        {{$campanha->categoria->categoria}}</option>
                                                    @foreach ($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->categoria}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="d-flex flex-column">
                                                <div class="form-group campanha-content flex-row">
                                                    <input type="hidden" value="{{$campanha->inicio}}"
                                                        name="campanhaInicio">
                                                    <label for="inicio"> Data de inicio atual:
                                                        {{date('d-m-Y', strtotime($campanha->inicio))}}</label>
                                                    <input type="date" data-target="{{$campanha->inicio}}"
                                                        value="{{$campanha->inicio}}" name="inicio"
                                                        class="form-control col-10" id="inicio">
                                                </div>

                                                <div class="form-group campanha-content flex-row">
                                                    <input type="hidden" value="{{$campanha->fim}}" name="campanhaFim">
                                                    <label for="fim"> Data de fim atual:
                                                        {{date('d-m-Y', strtotime($campanha->fim))}}</label>
                                                    <input type="date" value="{{$campanha->fim}}" name="fim"
                                                        class="form-control col-10" id="fim">
                                                </div>
                                                <input type="hidden" name="id_marca" value='{{ Auth::user()->id }}'>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Alterar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class=" modal fade" id="deleteModal{{$campanha->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content modal-excluir-campanha">
                                <section class="d-flex flex-row align-items-center justify-content-center">
                                    <div class="col-6">
                                        <p>Excluir campanha</p>
                                        <img class="img-fluid" src="{{url($campanha->imagem)}}" alt="">
                                    </div>
                                    <div class="col-6">
                                        <form method="POST" action="/home/{{$campanha->id}}"
                                            enctype="multipart/form-data" id="deleteForm">

                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            <div class="form-group">
                                                <p>
                                                    Deseja realmente deletar a campanha:
                                                </p>
                                                <p>{{$campanha->titulo}}?</p>
                                            </div>
                                            <input type="hidden" value="DELETE" name="_method">

                                            <div class="form-group">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Excluir</button>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>




<div class=" modal fade modalInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-criar-campanha">
            <section class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-6">
                    <p>Criar Campanha</p>
                    <img class="img-fluid" src="image/campanha.jpg" alt="">
                </div>
                <div class="col-6">
                    <form method="POST" action="{{ action('HomeController@store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_marca" value='{{ Auth::user()->id }}'>
                        <div class="form-group campanha-content campanha-top">
                            <label for="titulo">Título da Campanha</label>
                            <input type="text" name="titulo" class="form-control">
                        </div>

                        <div class="form-group campanha-content">
                            <label for="descricao">descricao</label>
                            <input type="text" name="descricao" class="form-control">
                        </div>

                        <div class="form-group campanha-content">
                            <label for="imagem">Imagem</label>
                            <input type="file" name="imagem" class="form-control">
                        </div>

                        <div class="form-group campanha-content">
                            <label for="categoria">categoria</label>
                            <select name="categoria" class="form-control">
                                <option value="">Selecione a categoria</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex flex-column">
                            <div class="form-group campanha-content flex-row">
                                <label for="inicio"> Data de Inicio</label>
                                <input type="date" name="inicio" class="form-control col-10">
                            </div>

                            <div class="form-group campanha-content flex-row">
                                <label for="fim"> Data de fim</label>
                                <input type="date" name="fim" class="form-control col-10">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Criar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

@endif
{{-- FIM DA MARCA --}}
@endauth


{{-- FIM DE VALIDAÇÃO --}}
@endsection
