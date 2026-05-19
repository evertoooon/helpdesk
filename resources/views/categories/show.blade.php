<x-app-layout>

<div class="py-6 max-w-4xl mx-auto">

<h1 class="text-2xl font-bold">

{{ $category->name }}

</h1>

<p>

{{ $category->description }}

</p>

<p>

Status:

{{ $category->active ? 'Ativa' : 'Inativa' }}

</p>

</div>

</x-app-layout>