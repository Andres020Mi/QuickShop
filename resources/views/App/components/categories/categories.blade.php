<div class="categories">
    @forelse ($categories  as $category )
    <a href="/?c={{$category->id}}">
        {{$category->name}}
    </a>     
    @empty
    <a href="">
        sin categorias
    </a>
    @endforelse
   
</div>