@props(['text' => 'Go Back'])

<a
    href="javascript:history.back()"
    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-medium text-sm leading-5 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-400 focus:ring-opacity-50 mb-4"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
    </svg>
    {{ $text }}
</a>
