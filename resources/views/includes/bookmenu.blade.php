<div class="mb-12">
    <div class="flex items-center justify-between">  
    @if($selectedCategory)
    <h1  class="text-lg md:text-3xl">{{$selectedCategory->title}}</h1>
    @else
    <h1  class="text-lg md:text-3xl">CLA Books</h1>
    @endif
    @if($cartItems)
    <a href="/cart" class="no-underline text-blue text-lg font-bold" ><i class="fas fa-shopping-cart"></i> View Cart <span class="text-red-500" >{{$cartItems}}</span></a>
    @endif
    </div>
    <!-- <div class="categories">
        <button type="button" onclick="toggleCategories()" class="no-underline text-blue font-bold">View Categories <i class="fas fa-chevron-down text-xs"></i></button>
        <ul class="list-reset hidden" v-if="showCats">
            <li class="inline-block mr-4"><button type="button" onclick="selectCategory('all')" class="no-underline text-grey-dark">All</button></li>
            @foreach($categories as $category)
            <li class="inline-block mr-4" ><button  type="button" onclick="selectCategory({{$category->id}})" class="no-underline text-grey-dark" >{{ $category->title }}</button></li>
            @endforeach
        </ul>
    </div> -->
</div>