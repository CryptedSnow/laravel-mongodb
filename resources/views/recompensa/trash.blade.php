@extends('templates.template_hunter')
@section('title', 'Lixeira de recompensas')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Lixeira de recompensas
                            <a href="{{ url("reward") }}" class="btn btn-secondary float-end" title="Voltar"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-reward-trash') }}" method="GET" class="form-inline">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Filtrar por descrição da recompensa">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                          </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Data de exclusão</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recompensa as $r)
                                <tr>
                                    <td>{{ $r->descricao_recompensa }}</td>
                                    <td>@dinheiro($r->valor_recompensa)</td>
                                    <td>{{ \Carbon\Carbon::parse($r->deleted_at)->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <form action="{{ url("delete-register-reward/".$r->_id) }}" method="POST">
                                            <a href="{{ url("restore-register-reward/".$r->_id) }}" class="btn btn-primary"><i class="fa fa-arrows-rotate"></i>&nbsp;Restaurar</a>
                                            {{ ' ' }} {{ method_field('DELETE') }} {{ csrf_field() }}
                                            {{-- <button type="submit" class="btn btn-danger delete-button"><i class="fa fa-trash"></i>&nbsp;Deletar</button> --}}
                                        </form>
                                    </td>
                                </tr>
	                        @endforeach
                        </tbody>
                    </table>
                    {{ $recompensa->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtenha todos os botões de exclusão pela classe CSS
            const deleteButtons = document.querySelectorAll('.delete-button');

            // Adicione um evento de clique a cada botão de exclusão
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Impede o envio do formulário
                    confirmDelete('Excluir Recompensa', 'Deseja excluir permanentemente esta recompensa?'); // Modal de confirmação
                });
            });

            function confirmDelete(title, text, id) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Continue com a ação
                        document.querySelector('form').submit();
                    }
                });
            }
        });
    </script>
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                <em> Iury Fernandes, {{ date('Y') }}.</em>
            </div>
        </div>
    </footer>
@endsection
