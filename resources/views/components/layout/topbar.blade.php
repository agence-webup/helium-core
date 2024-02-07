@props(['title', 'actions' => null])


<div class="sticky top-0 z-50 flex items-center justify-between border-x-0 border-t-0 border-b border-solid border-gray-200 bg-white py-3 px-5 leading-6 text-slate-800" style="border-width: 0px; list-style: outside;">
    <h1 class="m-0 text-xl font-medium leading-7 text-slate-700" style="list-style: outside;">
        {{ $title }}
    </h1>
    @if ($actions)
        <div class="flex items-center space-x-2 text-slate-800" style="list-style: outside;">
            {{ $actions }}
        </div>
    @endif
</div>
