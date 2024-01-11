<?php

use Livewire\Volt\Component;
use Illuminate\Support\Str;
use App\Models\Url;
use Illuminate\Support\Facades\Http;

new class extends Component {

    public $title;
    public $url;
    public $short_url;

    public function save(){
        $this->validate([
            'url' => 'required'
        ]);

        $shortUrl = $this->short_url ?? Str::random(6);

        $title = $this->title();

        Url::create([
            'url' => $this->url,
            'title' => $title,
            'short_url' => $shortUrl,
            'user_id' => auth()->id(),
        ]);

        $this->redirect(route('links.index'));
    }

    public function title(){
        // If the value of the title input is empty get the title from the url using the http client
        if(empty($this->title)){
            $response = Http::get($this->$url);
            $html = $response->body();

            // Use the Str helper to extract the title content
            $start = Str::pos($html, '<title>') + 7;
            $end = Str::pos($html, '</title>', $start);

            $title = Str::substr($html, $start, $end - $start);

            return $title;
        }
        return $this->title;
    }

};

?>

<div class="space-y-4">
    <x-input label="Destination" placeholder="example.com/my-long-url" icon-right="o-globe-alt" wire:model="url" wire:keydown.enter="title" clearable />
    <x-input label="Title" placeholder="My URL" icon="" wire:model="title"/>
    <x-input label="Short URL" prefix="{{env('APP_URL')}}" placeholder="my-short-url" icon-right="o-link" wire:model="short_url" />
    <x-button label="Shorten URL" icon="o-link" wire:click="save" spinner />
</div>
