@extends('layout')
@section('content')
<title>Obra - </title>
<script>
    $(document).ready(function() {
        $('#newConstructionBtn').on('click', function() {
            $('.modal-title').text('Nova Obra');
            $('#submitobra').text('Criar');
            $('#submitobra').val('create');
            $('#cname').val("");
            $('#type').val("");
            $('#zipcode').val("");
            $('#address').val("");
            $('#number').val("");
            $('#complement').val("");
            $('#neighborhood').val("");
            $('#city').val("");
            $('#state').val("");
            $('#responsible').val("");
            $('#phonenumber').val("");
            $('#newConstructionModal').show();
        });

        $('.btn-close').on('click', function() {
            $('#newConstructionModal').hide();
        });
        $('#cancelBtn').on('click', function() {
            $('#newConstructionModal').hide();
        });

        $('.btn-edit-sm').click(function() {
            var buttonValue = $(this).val();
            
            $('#newConstructionModal').show();
            $('.modal-title').text('Editar Obra');
            $('#submitobra').text('Editar');
            $('#submitobra').val('');
            $('#submitobra').val(buttonValue);
            axios.get('/fetch-construction/'+buttonValue)
            .then(function(response) {
                console.log("frontend", response);
                $('#cname').val(response.data.construction.name);
                $('#type').val(response.data.construction.type);
                $('#zipcode').val(response.data.construction.zipcode);
                $('#address').val(response.data.construction.address);
                $('#number').val(response.data.construction.number);
                $('#complement').val(response.data.construction.complement);
                $('#neighborhood').val(response.data.construction.neighborhood);
                $('#city').val(response.data.construction.city);
                $('#state').val(response.data.construction.state);
                $('#responsible').val(response.data.construction.responsible);
                $('#phonenumber').val(response.data.construction.phonenumber);
            })
            .catch(function(error) {
                console.log(error)
            })
            
        });

        $('.btn-delete-sm').click(function() {
            const itemId = $(this).data('id');
            
            // Save a reference to the table row containing the button
            const currentItem = $(this).closest('tr');

            // Show the confirmation modal
            $('#confirmationModal').show();

            $('#confirmBtn').click(function() {
                // Remove the corresponding table row
                currentItem.remove();
                // Send the item ID to the backend using AJAX
                axios.get('/remove/construction/'+itemId)
                .then(function(response) {
                    console.log('success removed')
                })
                .catch(function(error) {
                    console.log(error);
                })

                // Hide the confirmation modal
                $('#confirmationModal').hide();
            });

            $('#cancelRemoveBtn').click(function() {
                // Hide the confirmation modal without doing anything
                $('#confirmationModal').hide();
            });
        });
            
        $('#zipbutton').on('click', function() {
            console.log('zipbutton clicked')
            var postalCode = $('#zipcode').val();
            
            // Send AJAX request
            axios.get('/fetch-address/'+postalCode)
            .then(function(response) {
                console.log("response", response.data);
                // Update the address fields with the received data
                $('#address').val(response.data.address);
                $('#street').val(response.data.street);
                $('#city').val(response.data.city);
                
                // Additional fields if needed
                // $('#state').val(response.data.state);
                // $('#country').val(response.data.country);
            })
            .catch(function(error) {
                console.log("error", error);
        });
    });
 });
</script>
<div class="container pb-5">
    @include('includes.flash.success')
    @include('includes.flash.error')
    @include('includes.flash.validation')
    <section class="section mt-3 mb-1">
        <div class="container">
            <div class="page-title justify-content-center">
                <h5>Obra</h5>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4>Listar Obra</h4>
        <button class="btn btn-primary btn-sm" id="newConstructionBtn"><i class="bi bi-plus-circle"></i>Nova Obra</button>
    </div>
    <div id="confirmationModal" class="modal">
        <div class="modal-content" style="width: fit-content">
            <h1 class="text-center"><i class="bi bi-emoji-frown"></i></h1>
            <p class="text-center fs-2">Tem certeza?</p>
            <div class="text-center">
                <button class="btn btn-outline-primary btn-sm" id="cancelRemoveBtn">Não</button>
                <button class="btn btn-primary btn-sm" id="confirmBtn">Sim</button>
            </div>
        </div>
    </div>
    <div id="newConstructionModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content bg-white rounded shadow" style="min-width:400px">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Obra</h5>
                    <button type="button" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('post.newconstruction')}}" method="post">
                        @csrf
                        <div class="mb-2">
                            <label for="address" class="form-label">Obra <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="cname" name="cname" placeholder="Carrinho de compras" required>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Tipo Obra <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" id="type" name="type">
                                <option value="Codominio" selected>Codominio</option>
                                <option value="Casa" >Casa</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">CEP <span class="text-danger">*</span></label>
                            <div class=" d-flex justify-content-between align-items-center gap-4">
                                <input type="text" class="form-control form-control-sm" id="zipcode" name="zipcode" placeholder="41410" required>
                                <button class="btn btn-primary btn-sm" id="zipbutton" type="button">Buscar</button>
                            </div>
                        </div>
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-8">
                                <label for="address" class="form-label">Endereco <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Eusebio Dávila 39" required>
                            </div>
                            <div class="col-4">
                                <label for="address" class="form-label">Numero <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="number" name="number" placeholder="39" required>
                            </div>
                        </div>
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-6">
                                <label for="address" class="form-label">Complemento</label>
                                <input type="text" class="form-control form-control-sm" id="complement" name="complement" placeholder="Eusebio">
                            </div>
                            <div class="col-6">
                                <label for="address" class="form-label">Bairro <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="neighborhood" name="neighborhood" placeholder="Eusebio" required>
                            </div>
                        </div>
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-6">
                                <label for="address" class="form-label">Cidade <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="city" name="city" placeholder="Carmona" required>
                            </div>
                            <div class="col-6">
                                <label for="address" class="form-label">Estado <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="state" name="state" placeholder="Seville" required>
                            </div>
                        </div>
                        <div class="mb-2 d-flex gap-1">
                            <div class="col-6">
                                <label for="address" class="form-label">Responsável de Construção <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="responsible" name="responsible" placeholder="" required>
                            </div>
                            <div class="col-6">
                                <label for="address" class="form-label">Número de telefone <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="phonenumber" name="phonenumber" placeholder="15198821313" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-2">
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
                        <th scope="col">Obra</th>
                        <th scope="col">Tipo Obra</th>
                        <th scope="col">Endereco</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Complemento</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">telefone</th>
                        <th scope="col">Registrado em</th>
                        <th scope="col">Status</th>
                        <th scope="col">Acao</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allConstructions as $item)    
                    <tr>
                        <td data-label="Obra">{{$item->name}}</td>
                        <td data-label="Tipo Obra">{{$item->type}}</td>
                        <td data-label="Endereco">{{$item->address}}</td>
                        <td data-label="Numero">{{$item->number}}</td>
                        <td data-label="Complemento">{{$item->complement}}</td>
                        <td data-label="Bairro">{{$item->neighborhood}}</td>
                        <td data-label="Cidade">{{$item->city}}</td>
                        <td data-label="Estado">{{$item->state}}</td>
                        <td data-label="Responsável">{{$item->responsible}}</td>
                        <td data-label="telefone">{{$item->phonenumber}}</td>
                        <td data-label="Registrado em">{{date('Y-m-d', strtotime($item->created_at))}}</td>
                        <td data-label="Status">{{$item->status}}</td>
                        <td class="table-action" data-label="Acao">
                            <button class="btn-edit-sm mb-1" value={{$item->id}}>Editar</button>
                            <button class="btn-delete-sm" data-id={{$item->id}}>Excluir</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11">Ainda não há obras</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop