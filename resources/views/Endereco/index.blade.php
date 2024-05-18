<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Endereço') }}
        </h2>
    </x-slot>
    <div class="rounded-lg border border-gray-200 m-5 px-1 py-8 sm:px-8">
        <div class="overflow-x-auto rounded-t-lg text-end pb-5 pt-1 px-4">
            <a href="#" class="inline-block border-e rounded bg-blue-800 px-4 py-2 text-xs font-medium text-white hover:bg-blue-600">
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
							<a href="#DELETE"
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
                    <a
                        href="#"
                        class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
                    >
                        <span class="sr-only">Prev Page</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    >
                        1
                    </a>
                </li>

                <li class="block size-8 rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">
                    2
                </li>

                <li>
                    <a
                        href="#"
                        class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    >
                        3
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
                    >
                        4
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
                    >
                        <span class="sr-only">Next Page</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </a>
                </li>
            </ol>
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
