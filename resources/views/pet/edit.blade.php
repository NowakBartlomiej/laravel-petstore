<head>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
<div>
    <form method="POST" action="{{ route('pets.update', $pet['id']) }}" class="w-[50%] border border-gray-400 rounded-xl mx-10 my-10 px-5 py-5">
        @csrf
        @method('PUT')
        <h1 class="text-2xl pb-6">Add Pet</h1>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="category">
                Category
            </label>
            @if ($errors->get('category'))
                <div class=" text-red-500 rounded-xl">
                    <ul>
                        @foreach ($errors->get('category') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div>    
            @endif
            <input
                name="category"
                value="{{ isset($pet['category']) ? $pet['category']['name'] : "" }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="category" type="text" placeholder="Enter pet category">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">
                Name
            </label>
            @if ($errors->get('name'))
                <div class=" text-red-500 rounded-xl">
                    <ul>
                        @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div>    
            @endif
            <input
                name="name"
                value="{{ isset($pet['name']) ? $pet['name'] : "" }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name" type="text" placeholder="Enter pet name">
        </div>

        <div id="photos">
            <label class="block text-gray-700 font-bold mb-2" for="service">
                Photos
            </label>
            @if ($errors->get('photoUrls'))
                <div class=" text-red-500 rounded-xl">
                    <ul>
                        @foreach ($errors->get('photoUrls') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div>    
            @endif

            <input value="{{ isset($pet['photoUrls'][0]) ? $pet['photoUrls'][0] : "" }}" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="photoUrls[]" id="photo1" placeholder="Enter pet photo url"/>
            <button id="addPhoto" class="bg-blue-500 hover:bg-blue-400 transition-colors text-white px-4 py-2 rounded-full">Add More Photos</button>

            @if ($pet['photoUrls'] != null && count($pet['photoUrls']) > 1)
                @for ($i = 1; $i < count($pet['photoUrls']); $i++)
                <div><input value="{{ $pet['photoUrls'][$i] }}" placeholder="Enter pet photo url" id="{{ "photo" . $i}}" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="photoUrls[]"/><a href="#" class="remove_photo_field bg-red-500 hover:bg-red-400 ml-2 transition-colors text-white px-4 py-2 rounded-full">Remove</a></div>
                @endfor
            @endif
        </div>

        <div id="tags">
            @if ($errors->get('tags'))
                <div class=" text-red-500 rounded-xl">
                    <ul>
                        @foreach ($errors->get('tags') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div>    
            @endif
            <label class="block text-gray-700 font-bold mb-2" for="service">
                Tags
            </label>

            <input value="{{ isset($pet['tags'][0]['name']) ? $pet['tags'][0]['name'] : "" }}" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tags[]" id="tag1" placeholder="Enter pet tag"/>
            <button id="addTag" class="bg-blue-500 hover:bg-blue-400 transition-colors text-white px-4 py-2 rounded-full">Add More Tags</button>
            @if ($pet['tags'] != null && count($pet['tags']) > 1)
                @for ($i = 1; $i < count($pet['tags']); $i++)
                    <div><input value="{{ $pet['tags'][$i]['name'] }}" placeholder="Enter pet photo url" id="{{ "tags" . $i}}" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tags[]"/><a href="#" class="remove_tag_field bg-red-500 hover:bg-red-400 ml-2 transition-colors text-white px-4 py-2 rounded-full">Remove</a></div>
                @endfor
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="service">
                Status
            </label>
            @if ($errors->get('status'))
                <div class=" text-red-500 rounded-xl">
                    <ul>
                        @foreach ($errors->get('status') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div>    
            @endif
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="status" name="status">
                <option value="" {{ !isset($pet['status']) && 'selected' }}>Select a status</option>
                <option value="available" {{ $pet['status']=='available' ? 'selected' : ''  }}>available</option>
                <option value="pending" {{ $pet['status']=='pending' ? 'selected' : ''  }}>pending</option>
                <option value="sold" {{ $pet['status']=='sold' ? 'selected' : ''  }}>sold</option>
            </select>
        </div>

        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">Submit</button>
    </form>
</div>


<script>
    
    $(document).ready(function() {
    
    // Photos
    var photos = $("#photos")
    var addPhoto = $("#addPhoto")

    var i = 1;
    $(addPhoto).click(function(e) {
        e.preventDefault();
        ++i;
        $(photos).append(`<div><input placeholder="Enter pet photo url" id="photo`+i+`" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="photoUrls[]"/><a href="#" class="remove_photo_field bg-red-500 hover:bg-red-400 ml-2 transition-colors text-white px-4 py-2 rounded-full">Remove</a></div>`)
    })

    $(photos).on("click", ".remove_photo_field", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        i--;
    })

    // Tags
    var tags = $("#tags"); 
    var addTag = $("#addTag");

    var j = 1; 
    $(addTag).click(function(e){ 
        e.preventDefault();
            ++j; 
            $(tags).append(`<div><input placeholder="Enter pet tag" id="tag`+j+`" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tags[]"/><a href="#" class="remove_tag_field bg-red-500 hover:bg-red-400 ml-2 transition-colors text-white px-4 py-2 rounded-full">Remove</a></div>`); 
       
    });

    $(tags).on("click",".remove_tag_field", function(e){
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        j--;
    })
});
</script>

</body>