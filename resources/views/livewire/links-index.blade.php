<?php

use Livewire\Volt\Component;
use App\Models\Url;

new class extends Component{

    public function mount()
    {
        $this->urls = Url::where('user_id', auth()->id());
    }

    public function delete($id)
    {
        // Find the Url by id
        Url::where('id', $id)->delete();

        $this->refresh();
    }

    public function refresh()
    {
        // Refresh the Urls
        $this->urls = Url::where('user_id', auth()->id());
    }
}

?>

<div>
    @php
        $urls = Url::where('user_id', auth()->id())->get();
    @endphp
    @forelse($urls as $url)
        <x-list-item :item="$url" no-separator no-hover>
            <x-slot:avatar>
                <x-badge value="{{$url->short_url}}" class="badge-primary" />
            </x-slot:avatar>
            <x-slot:value>
                <h3 class="text-gray-900 dark:text-gray-100 text-lg font-semibold">{{$url->title}}</h3>
            </x-slot:value>
            <x-slot:sub-value>
                <h6 class="text-gray-500 dark:text-gray-400 text-sm">
                    <a href="{{route('links.show', $url->short_url)}}" target="_blank">{{route('links.show', $url->short_url)}}</a>
                </h6>
            </x-slot:sub-value>
            <x-slot:actions>
                {{-- <x-button icon="o-link" class="text-blue-500" target="_blank" href="{{route('links.show', $url->id)}}" /> --}}
                <span class="text-gray-500 dark:text-gray-400 text-sm">{{$url->visits}} clicks</span>
                <x-button icon="o-trash" class="text-red-500" wire:click="delete('{{$url->id}}')" spinner />
            </x-slot:actions>
        </x-list-item>
    @empty
        <x-list-item>
            <x-slot:value>
                <h3 class="text-gray-900 dark:text-gray-100 text-lg font-semibold">No URLs found</h3>
            </x-slot:value>
        </x-list-item>
    @endforelse
</div>
