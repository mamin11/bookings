<div class="mdb-lightbox">
    
    <div class="row product-gallery mx-1">

        <div class="col-12 mb-5">
        <figure class="view overlay rounded z-depth-1 main-img">
            <img src="{{ $selected ? $selected : 'https://via.placeholder.com/500' }}"
                class="img-fluid z-depth-1">
            </a>
        </figure>
        </div>
        <div class="col-12">
        <div class="row">
            @if($images)
            {{-- @dd($currentIndex) --}}
            @foreach($images as $image)
                    <div class="col-3 cursor-pointer @if($currentIndex == $image) shadow-lg @endif" wire:key='{{$loop->index}}' wire:click='selectImage({{$loop->index}})'>
                        <div class="view overlay rounded z-depth-1 gallery-item">
                            <img src="{{ $image }}"
                            class="img-fluid">
                            <div class="mask rgba-white-slight"></div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        </div>
    </div>

    </div>