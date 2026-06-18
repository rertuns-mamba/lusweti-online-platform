<div>
    @foreach($page->sections as $section)
        @livewire(
            'sections.' . $section->component,
            [
                'page'     => $page,
                'section'  => $section,         
                'settings' => $section->settings ?? [] 
            ],
            key($section->id)
        )
    @endforeach
</div>


