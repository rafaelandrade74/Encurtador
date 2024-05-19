<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <section class="bg-white">
        <div class="lg:grid m-10 grid-cols-12">

            <main class="flex justify-center px-8 py-8 col-span-12">
                <div class="max-w-xl lg:max-w-3xl">
                    <h1 class="mt-1 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        {{$endereco->nome}}
                    </h1>
                    <div class="mt-8 grid grid-cols-6 gap-6">
                        <div class="col-span-5">
                            <label for="slug" class="block text-sm font-medium text-gray-700">
                                url nova:
                            </label>

                            <input
                                type="text"
                                id="slug_url"
                                name="slug"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                                readonly
                                value="{{route('home',['slug'=> $endereco->slug])}}"
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

                        <div class="col-span-5">
                            <label for="slug_para" class="block text-sm font-medium text-gray-700">
                                Url para redirecionar 🌐:
                            </label>

                            <input
                                type="text"
                                id="slug_para"
                                name="slug_para"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                                placeholder="https://www.google.com"
                                readonly
                                value="{{$endereco->slug_para}}"
                            />
                        </div>
                        <div class="col-span-1 mt-6">
                            <label for="slug_para" class="block text-sm font-medium text-gray-700">
                                Número de clicks: {{$visitas}}
                            </label>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </section>

</x-app-layout>
<script>
    function copiarTextoInput() {
        event.preventDefault();
        let url = $('input#slug_url').val();
        navigator.clipboard.writeText(url);
        Swal.fire({
            title: 'Sucesso',
            html: 'Copiado com sucesso!',
            icon: 'success'
        })
    }
</script>
