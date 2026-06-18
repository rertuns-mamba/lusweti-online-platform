<!-- wire:poll.60s="render" -->

<div  class="space-y-8">
    @foreach($widgets as $widget)
        <section class="border-t-2 border-black pt-4">
            <h3 class="font-bold text-sm uppercase tracking-wider mb-4">{{ $widget->title }}</h3>
            
            @include('partials.widgets.' . $widget->type, ['data' => $widget->content_data])
        </section>
    @endforeach
</div>