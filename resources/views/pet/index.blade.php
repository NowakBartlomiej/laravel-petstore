<head>
    @vite('resources/css/app.css')
</head>

<div>
    <h1 class="text-3xl mb-4">Pets</h1>
        <a href="{{ route('pets.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">Add Pet</a>


        <h2 class="mt-4">Status: {{ $statusRequest }}</h2>

        <h2 class="text-lg">Change status:</h2>
        <div class="flex gap-5 text-sm">
            <a href="pets?status=available" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full">available</a>
            <a href="pets?status=pending" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">pending</a>
            <a href="pets?status=sold" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full">sold</a>
        </div>
    
    

    <table class=" divide-y divide-gray-200 dark:divide-neutral-700">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">id</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">category</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">name</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">photosUrl</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">tags</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">Edit</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">Delete</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
            @foreach ($pets as $pet)
                {{-- {{ dd($pet['name']) }} --}}
                <tr class="text-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  ">{{ $pet['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['category']))
                                @if (isset($pet['category']['name']))
                                <p>{{ $pet['category']['name'] }}</p>
                                @else
                                    <p>null</p>
                                @endif

                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 max-w-80 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['name']))
                            <p class="text-wrap break-all">{{ $pet['name'] }}</p>
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 max-w-80 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['photoUrls']))  
                            @foreach ($pet['photoUrls'] as $photo)
                                        <p class="text-wrap break-all">{{ $photo }}</p>
                                @endforeach
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['tags']))
                            @foreach ($pet['tags'] as $tag)
                                @if (isset($tag['name']))
                                    <p>{{ $tag['name'] }}</p>
                                @else
                                    <p>null</p>
                                @endif
                            @endforeach
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">{{ $pet['status'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        <a class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full" href="">Edit</a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" href="">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
</div>
