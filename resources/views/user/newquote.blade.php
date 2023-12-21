@extends('layout')
@section('content')
<title>Nova Cotacao - </title>
<script>
$(document).ready(function() {
    $('.category1').click(function() {
        console.log("afasdf")
        const itemId = $(this).data('value');

        axios.get('/fetch-category/'+itemId)
        .then(function(response) {
            $('#category_name').text(response.data.category.name);
            const items = response.data.items;
            var context = ""

            items.forEach(item => {
                context+= "<option value="+item.id+">"+item.name+"</option>";
            });
            $('#item').html(context);
        })
        .catch(function(error) {
            console.lgo(error);
        })
    });
    
    $('#item').on("change", function() {
        var selectedValue = $(this).val();
        axios.get('/fetch-category/'+selectedValue)
        .then(function(response) {
            console.log(response.data.category.measurement)
            $('#measurement').val(response.data.category.measurement)
        })
        .catch(function(error) {
            console.lgo(error);
        })
    })
})
</script>
<div class="container">
    @include('includes.flash.success')
    @include('includes.flash.error')
    @include('includes.flash.validation')
    <section class="section mt-3 mb-1">
        <div class="container">
            <div class="page-title justify-content-center">
                <h5>Nova Cotacao</h5>
            </div>
        </div>
    </section>
    <div class="">
        <form action="{{route('post.additems')}}" class="mt-5 text-center" method="post">
            @csrf
            <div class="mx-auto w-50 d-flex gap-1 align-items-center">
                <input type="text" class="form-control from-control-sm" name="name" value="{{$quote_name}}" placeholder="Nome Cotacao:" required>
            </div>
            <div class="table-responsive overflow-hidden mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nome Obra</th>
                            <th scope="col">Items</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Acao</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse($items as $item)
                        <tr>
                            <td data-label="Nome">{{$item->construction->name}}</td>
                            <td data-label="Item da lista"></td>
                            <td data-label="Data solicitacao"></td>
                            <td data-label="Preço"></td>
                            <td data-label="Status"></td>
                            <td class="table-action" data-label="Acao">
                                <button class="btn-delete-sm">Excluir</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Nenhum adicionado ainda</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mx-auto align-items-center">
                <div class="row mb-4">
                    <div class="col-4">
                        <select class="form-control form-control-sm" name="construction" id="construction">
                            @foreach($constructions as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <ul class="main-navigation">
                            <li>
                                <span id="category_name">Categoria</span>
                                <ul>
                                    @foreach($categories as $item)
                                    <li>
                                        <a>{{ $item->name }}</a>
                                        <ul>
                                            @foreach($item->subcategories() as $item)
                                            <li>
                                                <a>{{$item->name}}</a>
                                                <ul>
                                                    @foreach($item->subcategories() as $item)
                                                    <li><a class="category1" data-value={{$item->id}}>{{$item->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <select class="form-control form-control-sm" id="item" name="item">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                    <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="Unidade" required>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" id="measurement" name="measurement" placeholder="kg">
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-sm">Adicionar</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-primary mt-5">Completo</button>
        </form>
    </div>
</div>

@stop