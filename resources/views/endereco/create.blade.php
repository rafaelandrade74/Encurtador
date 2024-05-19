<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <section class="bg-white">
        <div class="lg:grid m-10 grid-cols-12">

            <main class="flex justify-center px-8 py-8 col-span-12">
                <div class="max-w-xl lg:max-w-3xl">
                    <h1 class="mt-1 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Cadastrar endereços para redirecionar 🌐
                    </h1>

                    <form action="{{route('endereco.store')}}" method="post" class="mt-8 grid grid-cols-6 gap-6">
                        @csrf
                        <div class="col-span-6">
                            <label for="nome" class="block text-sm font-medium text-gray-700">
                                Nome:
                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                                placeholder="Sapato cor laranja..."
                            />
                        </div>
                        <div class="col-span-5">
                            <label for="slug_url" class="block text-sm font-medium text-gray-700">
                                url nova:
                            </label>
                            <input type="hidden" id="slug" name="slug" >
                            <input
                                type="text"
                                id="slug_url"
                                name="slug_url"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                                readonly
                            />
                        </div>
                        <div class="col-span-1">

                            <button
                                onclick="copiarTextoInput()"
                                class="inline-block shrink rounded-md mt-6 border border-blue-600 bg-blue-600 px-6 py-2 text-sm text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                            >
                                Copiar
                            </button>
                        </div>

                        <div class="col-span-6">
                            <label for="slug_para" class="block text-sm font-medium text-gray-700">
                                Url para redirecionar 🌐:
                            </label>

                            <input
                                type="text"
                                id="slug_para"
                                name="slug_para"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                                placeholder="https://www.google.com"
                            />
                        </div>
                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button
                                type="submit"
                                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                            >
                                Salvar
                            </button>

                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>


</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#nome').on('input', function () {
            const guid = crypto.randomUUID();
            const url = '{{route('home',['slug'=> '@alterar'])}}'.replace('@alterar', guid);
            $('input#slug').val(guid);
            $('input#slug_url').val(url);
        });
    }, false);

function copiarTextoInput(){
    event.preventDefault();
    let url = $('input#slug_url').val();
    navigator.clipboard.writeText(url);
    Swal.fire({
        title:'Sucesso',
        html: 'Copiado com sucesso!',
        icon: 'success'
    })
}
</script>
