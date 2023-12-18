<div>
    <div class="max-w-2xl m-auto shadow-md rounded-md bg-white lg:mt-20">  
 
        <!-- form header -->
        <div class="text-center border-b border-gray-100 py-6">
            <h3 class="font-bold text-xl"> Góp ý </h3>
        </div>

        <!-- form body -->
        <div class="p-10 space-y-7">

            <div class="line">
                <input class="line__input" wire:model='name' id="" name="" type="text" onkeyup="this.setAttribute('value', this.value);" value="" autocomplete="off">
                <span for="username" class="line__placeholder"> Họ tên </span>
            </div>
            @if ($errors->has('name'))
                @foreach ($errors->get('name') as $error)
                    <small class="text-red-500">{{ $error }}</small>
                @endforeach
            @endif

            <div class="line">
                <input class="line__input" wire:model='email' id="" name="" type="email" onkeyup="this.setAttribute('value', this.value);" value="" autocomplete="off">
                <span for="username" class="line__placeholder"> Email </span>
            </div>
            @if ($errors->has('email')) 
            @foreach ($errors->get('email') as $error)
                <small class="text-red-500">{{ $error }}</small>
            @endforeach
        @endif

            <div class="line h-32"> 
                <textarea class="line__input h-32" wire:model='content'  id="" name="" type="text" onkeyup="this.setAttribute('value', this.value);" value="" autocomplete="off"></textarea>
                <span for="username" class="line__placeholder"> Nội dung </span> 
            </div>
            @if ($errors->has('content'))
            @foreach ($errors->get('content') as $error)
                <small class="text-red-500">{{ $error }}</div>
            @endforeach
        @endif
            
        </div>
        
        <!-- form footer -->
        <div class="flex justify-center border-gray-100 py-8">
            <button wire:click='submit' type="button" class="button lg:w-1/3">
                Gửi 
            </button>
        </div>
        
    </div>
</div>  