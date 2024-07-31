<head>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
<div>
    <form method="POST" action="" class="w-[50%] border border-gray-400 rounded-xl mx-10 my-10 px-5 py-5">
        @csrf
        <h1 class="text-2xl pb-6">Add Pet</h1>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="category">
                Category
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="category" type="text" placeholder="Enter pet category">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">
                Name
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name" type="text" placeholder="Enter pet name">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="service">
                Status
            </label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="status" name="status">
                <option value="">Select a status</option>
                <option value="available">available</option>
                <option value="pending">pending</option>
                <option value="sold">sold</option>
            </select>
        </div>

        <div id="photos">
            <label class="block text-gray-700 font-bold mb-2" for="service">
                Photos
            </label>
            <input class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="photo" id="photo1" placeholder="Enter pet photo url"/>
            <button id="addPhoto" class="bg-blue-500 hover:bg-blue-400 transition-colors text-white px-4 py-2 rounded-full">Add More Photos</button>
        </div>

        <div id="tags">
            <label class="block text-gray-700 font-bold mb-2" for="service">
                Tags
            </label>
            <input class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tag" id="tag1" placeholder="Enter pet tag"/>
            <button id="addTag" class="bg-blue-500 hover:bg-blue-400 transition-colors text-white px-4 py-2 rounded-full">Add More Tags</button>
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
        $(photos).append(`<div><input placeholder="Enter pet tag" id="tag`+i+`" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tag[]"/><a href="#" class="remove_photo_field bg-red-500 hover:bg-red-400 ml-2 transition-colors text-white px-4 py-2 rounded-full">Remove</a></div>`)
    })

    $(photos).on("click", ".remove_photo_field", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        j--;
    })

    // Tags
    var tags = $("#tags"); 
    var addTag = $("#addTag");

    var j = 1; 
    $(addTag).click(function(e){ 
        e.preventDefault();
            ++j; 
            $(tags).append(`<div><input placeholder="Enter pet tag" id="tag`+j+`" class="mb-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tag[]"/><a href="#" class="remove_tag_field bg-red-500 hover:bg-red-400 ml-2 transition-colors text-white px-4 py-2 rounded-full">Remove</a></div>`); 
       
    });

    $(tags).on("click",".remove_tag_field", function(e){
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        j--;
    })
});
    
    // let i = 0;

    // $('#addTag').click(() => {
    //     ++i;
    //     $('#tags').append(
    //         `<div class="mb-4" id="tag`+i+`">
    //                <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="tag[`+i+`][tag]" placeholder="Enter pet tag"/>
    //             <button class="bg-red-500 hover:bg-red-400 transition-colors text-white px-4 py-2 rounded-full" id="remove" type="button">Remove tag</button> 
    //         </div>`
    //     );
    // });

    // $(document).on('click', '#remove', () => {
    //     $(this).closest('div').remove();
    // })


</script>

</body>