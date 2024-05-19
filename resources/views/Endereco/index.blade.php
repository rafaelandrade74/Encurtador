<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Endereço') }}
        </h2>
    </x-slot>
    <div class="rounded-lg border border-gray-200 m-5 px-1 py-8 sm:px-8">
        <div class="overflow-x-auto rounded-t-lg text-end pb-5 pt-1 px-4">
            <a href="{{route('endereco.create')}}"
               class="inline-block border-e rounded bg-blue-800 px-4 py-2 text-xs font-medium text-white hover:bg-blue-600">
                <i class="bi bi-plus-circle"></i> Adicionar
            </a>
        </div>
        <div class="overflow-x-auto rounded-t-lg">
            <table class="border-collapse w-full border border-slate-400 bg-white text-sm shadow-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="w-1 border border-slate-300 font-semibold p-4 text-slate-900 text-left">#</th>
                    <th class="w-1/2 border border-slate-300 font-semibold p-4 text-slate-900 text-left">De</th>
                    <th class="w-1/2 border border-slate-300 font-semibold p-4 text-slate-900 text-left">Para</th>
                    <th class="w-1 border border-slate-300 font-semibold p-4 text-slate-900 text-left">#Ação</th>
                </tr>
                </thead>
                <tbody>
                @forelse($enderecos as $endereco)
                    <tr>
                        <td class="border border-slate-300 p-4 text-black-500">{{$endereco->id}}</td>
                        <td class="border border-slate-300 p-4 text-black-500">
                            <a href="{{route('home',['slug'=> $endereco->slug])}}"
                               target="_blank">{{route('home',['slug'=> $endereco->slug])}}</a>
                        </td>
                        <td class="border border-slate-300 p-4 text-black-500">{{$endereco->slug_para}}</td>
                        <td class="border order-slate-300 whitespace-nowrap px-4 py-2">
						<span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
							<a href="{{route('endereco.edit',['endereco'=> $endereco->id])}}"
                               class="inline-block border-e p-5 rounded bg-indigo-800 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-600">
								<i class="bi bi-pencil-square"></i> Editar
							</a>
							<a onclick="delEndereco({{$endereco->id}})" href="#"
                               class="inline-block border-l p-5 rounded border-black bg-red-700 px-4 py-2 text-xs font-medium text-white hover:hover:bg-red-400">
								<i class="bi bi-pencil-square"></i> Deletar
							</a>
						</span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <th colspan="4">Não tem valores a exibir :)</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
            <ol class="flex justify-end gap-1 text-xs font-medium">
                <li>
                    <a href="{{$enderecos->previousPageUrl()}}"
                       class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">
                        <span class="sr-only">Prev Page</span>
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>

                @php
                    $contador = 0;
                @endphp

                @for($page = $enderecos->currentPage(); $page <= $enderecos->lastPage(); $page++)
                    @if(($enderecos->lastPage() - $page) < 5 && $contador == 0)
                        @php $page = $enderecos->lastPage() - 4; @endphp
                    @endif
                    @if($contador < 5)
                        @php
                            $contador++;
                        @endphp
                        <li><a href="{{$enderecos->currentPage() == $page ? "#" : $enderecos->url($page)}}"
                               class="{{$enderecos->currentPage() == $page ? "block size-8 rounded border-blue-600 bg-blue-600 text-center leading-8 text-white"
                                : "block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"}}">
                                {{$page}}
                            </a>
                        </li>

                    @endif

                    @php
                        if($contador == 5){
                            $contador = 0;
                            break;
                        }
                    @endphp
                @endfor
                <li>
                    <a href="{{$enderecos->nextPageUrl()}}"
                       class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">
                        <span class="sr-only">Next Page</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </ol>
        </div>
    </div>
</x-app-layout>

<script>
    function delEndereco(id) {

        Swal.fire({
            title: "Você tem certeza?",
            text: `Gostaria de deletar o id ${id}!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, Deletar!",
            cancelButtonText: "Não!!!"
        }).then((result) => {
            if (result.isConfirmed) {

                const url = '{{route('endereco.destroy',['endereco' =>'@identificador'])}}'.replace('@identificador', id);
                const token = '{{csrf_token()}}';
                $.ajax({
                    type: "delete",
                    url: url,
                    data: {
                        "_token" : token
                    },
                    headers: {'X-CSRF-TOKEN': token},
                    contentType: false,
                    processData: false,
                    error: function (data){
                        console.log(data.responseJSON);
                        let retorno = "";
                        if(data.responseJSON !== undefined && data.responseJSON.message !== undefined) retorno = data.responseJSON.message;
                        Swal.fire({
                            title: 'Erro',
                            html: retorno,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                    success: function (data){
                        Swal.fire({
                            title: 'Deletado!',
                            html: `O Id ${id} foi deletado.`,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            document.location.href = '{{route('endereco')}}';
                        });
                    }
                });
            }
        });
    }
</script>
