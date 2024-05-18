<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Endereço') }}
        </h2>
        <div class="position-relative">
            <div class="col-0 position-absolute bottom-0 end-0 me-1 mt-2 mb-1">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#adicionarEndereco" ><i class="bi bi-plus-circle"></i>Add</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">De</th>
                            <th scope="col">Para</th>
                            <th scope="col">#Ação</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        https://icons.getbootstrap.com/icons/pencil-square/--}}
                        @forelse($enderecos as $endereco)
                        <tr>
                            <th scope="row">{{$endereco->id}}</th>
                            <td><a href="{{route('home',['slug'=> $endereco->slug])}}" target="_blank">{{route('home',['slug'=> $endereco->slug])}}</a></td>
                            <td>{{$endereco->slug_para}}</td>
                            <td><button type="button" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                        </tr>
                        @empty
                            <tr>
                                <th colspan="4">Não tem valores a exibir :)</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="adicionarEndereco" tabindex="-1" aria-labelledby="adicionarEndereco" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="adicionarEndereco">Adicionar novo endereço:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="adicionarEnderecoForm" action="{{route('endereco.store')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="slug" class="col-form-label">Url curta:</label>
                                        <input type="text" name="slug" class="form-control" id="slug" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug_para" class="col-form-label">Redirecionar para:</label>
                                        <input type="text" name="slug_para" class="form-control" id="slug_para">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary"  onclick="form_submit()">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const adicionarEndereco = document.getElementById('adicionarEndereco')
    if (adicionarEndereco) {
        adicionarEndereco.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const guid = uuid();
            const recipient = `${guid}`
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content. #slug
            //const modalTitle = adicionarEndereco.querySelector('.modal-title')
            const modalBodyInput = adicionarEndereco.querySelector('#slug')

            //modalTitle.textContent = `Adicionar novo endereço!`
            modalBodyInput.value = recipient
        })
    }
    function uuid() {
        return 'xxxx-4xxx-yxxx'
            .replace(/[xy]/g, function (c) {
                const r = Math.random() * 16 | 0,
                    v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
    }

    function form_submit() {
        let form = document.querySelector("#adicionarEnderecoForm");
        form.submit();
    }
</script>
