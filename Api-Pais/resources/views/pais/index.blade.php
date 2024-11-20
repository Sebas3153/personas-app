<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Paises') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="{{ route('pais.create') }}"
                class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded ml-2">Add</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Pais</th>
                                <th scope="col">Capital</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paises as $pais)
                                <tr>
                                    <th scope="row">{{ $pais->pais_codi }}</th>
                                    <td>{{ $pais->pais_nomb }}</td>
                                    <td>{{ $pais->muni_nomb }}</td>
                                    <td>
                                        <a href="{{ route('pais.edit', $pais->pais_codi) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Edit </a></li>
                                        <form action="{{ route('pais.destroy', $pais->pais_codi) }}"
                                            method='POST' style="display: inline-block">
                                            @method('delete')
                                            @csrf
                                            <input
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
                                                type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>