<div class="bg-black top-12 flex items-center justify-center min-h-screen">   

    <div class="scene w-[120px] h-[120px] cursor-pointer">
        <div class="cube text-black">
            <!-- Faces bound directly to the Livewire Reverb state -->
            <div class="face front">{{ $cube['front'] }}</div>
            <div class="face back">{{ $cube['back'] }}</div>
            <div class="face right">{{ $cube['right'] }}</div>
            <div class="face left">{{ $cube['left'] }}</div>
            <div class="face top">{{ $cube['top'] }}</div>
            <div class="face bottom">{{ $cube['bottom'] }}</div>
        </div>
    </div>
</div>