<head>
    @vite('resources/css/app.css')
</head>

<div>
    <h1 class="text-3xl">Pets</h1>

    <table class=" divide-y divide-gray-200 dark:divide-neutral-700">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">id</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">category</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">name</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">photosUrl</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">tags</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium  uppercase ">status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
            @foreach ($pets as $pet)
                {{-- {{ dd($pet['name']) }} --}}
                <tr class="text-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  ">{{ $pet['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['category']))
                            {{ $pet['category']['name'] }}
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['name']))
                        {{ $pet['name'] }}
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['photoUrls']))
                            @foreach ($pet['photoUrls'] as $photo)
                                <p>{{ $photo }}</p>
                            @endforeach
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                        @if (isset($pet['tags']))
                            @foreach ($pet['tags'] as $tag)
                                <p>{{ $tag['name'] }}</p>
                            @endforeach
                        @else
                            <p>null</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">{{ $pet['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
</table>
</div>
