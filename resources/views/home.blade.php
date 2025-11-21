<div class="max-w-2xl mx-aut ">
    @foreach ($chirps as $chirp)
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <div class="font-semibold">{{$chirp['author']}}</div>
                <div class="mt-1">{{$chirp['message']}}</div>
                <div class="text-sm text-gray-500 mt-2">{{$chirp['time']}}</div>
            </div>
        </div>
        <hr class="border-gray-200 dark:border-gray-700">
    @endforeach
</div>