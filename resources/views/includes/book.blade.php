<article  class="inline-flex flex-col w-56 m-2 " >
                <div class="photo w-full mb-4">
                <img  src="{{$book->photo}}" alt="{{$book->title}}" class="block h-48" >
                </div>
                <h4 class="title text-lg leading-tight font-medium">{{$book->title}}</h4>
                <p class="author italic font-medium">{{$book->author->name}}</p>
                <p class="desc leading-normal">{{$book->description}}</p>
                <p class="price font-medium text-red-500 italic mb-4">${{ number_format($book->cost, 2, '.', ',') }}</p>
                <form  class="add-to-cart flex-grow flex items-center" method="POST" action="/bookstore/add/{{$book->id}}">
                    @csrf
                <input type="number" name="quanity" class="form-input w-24 mr-4" min="0" placeholder="0">
                <input type="hidden" name="bookid" value="{{$book->id}}">
                <button type="submit" class="no-underline text-blue-500 uppercase tracking-wide text-sm">Add To Cart</button>
                </form>
    </article>