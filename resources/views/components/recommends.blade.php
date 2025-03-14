<div class="mb-6 w-full">
    <h2 class="mb-3 font-bold border-b border-gray-300 py-2">推薦商品</h2>
    <ul class="{{$format==2?'flex flex-wrap p-3 md:p-0':''}}">
        @foreach($recommends as $item)
            <li class="overflow-hidden mb-6 rounded shadow {{$format==2?'md:mr-6':''}}">
                <a href="/shop/product/{{$item['id']}}" class="{{$format==1?'flex':''}}">
                    <div class="{{$format==1?'w-1/4':'md:w-64'}}"><img src="/uploads/{{$item['cover']}}" alt="{{$item['prod_name']}}"></div>
                    <div class="p-2 flex-1">
                        <h3 class="mb-3">{{$item['prod_name']}}</h3>
                        <label class="text-black">${{$item['price']}}</label>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>