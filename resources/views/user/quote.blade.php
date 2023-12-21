@extends('layout')
@section('content')
<title>Obra - </title>
<script>
// $(document).ready(function() {
//     $('#newQuoteBtn').on('click', function() {
//         console.log("new clieck")
//         $('.modal-title').text('Nova Citar');
//         $('#submitobra').text('Criar');
//         $('#submitobra').val('create');
//         $('#category_name').text("Selecione a Categoria")
//         $('#quantity').val("");
//         $('#price').val("");
//         $('#newQuoteModal').show();
//         $('#item').html("")
//     });

//     $('.btn-close').on('click', function() {
//         $('#newQuoteModal').hide();
//     });
//     $('#cancelBtn').on('click', function() {
//         $('#newQuoteModal').hide();
//     });

//     $('.btn-edit-sm').click(function() {
//         var buttonValue = $(this).val();
        
//         $('#newQuoteModal').show();
//         $('.modal-title').text('Editar Citar');
//         $('#submitobra').text('Editar');
//         $('#submitobra').val('');
//         $('#submitobra').val(buttonValue);
//         axios.get('/fetch-quote/'+buttonValue)
//         .then(function(response) {
//             console.log("frontend", response);
//             $('#category_name').text(response.data.category_name)
//             $('#measurement').val(response.data.measurement)
//             $('#delivery_date').val(response.data.quote.delivery_date)
//             $('#quantity').val(response.data.quote.quantity)
//             $('#construction').val(response.data.quote.construction_id)
//             axios.get('/fetch-category/'+response.data.parent_id)
//             .then(function(response) {
//                 const items = response.data.items;
//                 var context = ""

//                 items.forEach(item => {
//                     context+= "<option value="+item.id+">"+item.name+"</option>";
//                 });
//                 $('#item').html(context);
//             })
//             .catch(function(error) {
//                 console.lgo(error);
//             })
            
//             $('#item').val(response.data.quote.category_id)
//         })
//         .catch(function(error) {
//             console.log(error)
//         })
        
//     });

//     $('.btn-delete-sm').click(function() {
//         const itemId = $(this).data('id');
        
//         // Save a reference to the table row containing the button
//         const currentItem = $(this).closest('tr');

//         // Show the confirmation modal
//         $('#confirmationModal').show();

//         $('#confirmBtn').click(function() {
//             // Remove the corresponding table row
//             currentItem.remove();
//             // Send the item ID to the backend using AJAX
//             axios.get('/remove/quote/'+itemId)
//             .then(function(response) {
//                 console.log('success removed')
//             })
//             .catch(function(error) {
//                 console.log(error);
//             })

//             // Hide the confirmation modal
//             $('#confirmationModal').hide();
//         });

//         $('#cancelConfirmBtn').click(function() {
//             // Hide the confirmation modal without doing anything
//             $('#confirmationModal').hide();
//         });
//     });
// });
</script>
<div class="container">
    @include('includes.flash.success')
    @include('includes.flash.error')
    @include('includes.flash.validation')
    <section class="section mt-3 mb-1">
        <div class="container">
            <div class="page-title justify-content-center">
                <h5>Cotacao</h5>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4>Listar Cotacao</h4>
        <a class="btn btn-primary btn-sm" id="newQuoteBtn" href="{{route("newquote", ['name' => 'Digite o nome da cotação antes de clicar em concluir...'])}}"><i class="bi bi-plus-circle"></i>Nova Cotacao</a>
    </div>
    <div id="confirmationModal" class="modal">
        <div class="modal-content" style="width: fit-content">
            <h1 class="text-center"><i class="bi bi-emoji-frown"></i></h1>
            <p class="text-center fs-2">Tem certeza?</p>
            <div class="text-center">
                <button class="btn btn-outline-primary btn-sm" id="cancelConfirmBtn">Não</button>
                <button class="btn btn-primary btn-sm" id="confirmBtn">Sim</button>
            </div>
        </div>
    </div>
    <div id="newQuoteModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content bg-white rounded shadow" style="min-width:400px">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Obra</h5>
                    <button type="button" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('post.newquote')}}" method="post">
                        @csrf
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-6">
                                <label for="address" class="form-label">Category <span class="text-danger">*</span></label>
                                <ul class="main-navigation">
                                    <li>
                                        <span id="category_name">Selecione a Categoria</span>
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
                            <div class="col-6">
                                <label for="address" class="form-label">Item <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="item" name="item">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-8">
                                <label for="address" class="form-label">Quantidade <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="100" required>
                            </div>
                            <div class="col-4">
                                <label for="address" class="form-label">Unidade <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="measurement" name="measurement" placeholder="kg">
                            </div>
                        </div>
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-8">
                                <label for="address" class="form-label">Obra <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="construction" name="construction">
                                    @foreach($allConstructions as $item)
                                    <option value={{$item->id}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="address" class="form-label">Data de entrega <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="delivery_date" name="delivery_date" placeholder="03/12/2023" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button type="submit" class="btn btn-primary btn-sm" name="submit_btn" id="submitobra" value="create">Criar</button>
                            <button type="button" class="btn btn-primary btn-sm" id="cancelBtn">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>      
    <div class="account-content">
        <div class="table-responsive overflow-hidden">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nome Cotacao</th>
                        <th scope="col">Item da lista</th>
                        <th scope="col">Data solicitacao</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Status</th>
                        <th scope="col">Acao</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allQuotes as $item)    
                    <tr>
                        <td data-label="Nome">{{$item->name}}</td>
                        <td data-label="Item da lista"></td>
                        <td data-label="Data solicitacao"></td>
                        <td data-label="Preço"></td>
                        <td data-label="Status"></td>
                        <td class="table-action" data-label="Acao">
                            <button class="btn-edit-sm mb-1" value={{$item->id}}>Editar</button>
                            <button class="btn-delete-sm" data-id={{$item->id}}>Excluir</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Ainda não há cotações</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop