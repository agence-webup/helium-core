<div class="flex flex-shrink-0 border-t border-gray-200 px-4">
    <div class="group block w-full flex-shrink-0">
        <div class="flex h-[70px] items-center">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-slate-200">
                <span class="text-xs font-medium leading-none text-slate-700">
                    {{ substr('Homer', 0, 1) }}{{ substr('Simpson', 0, 1) }}
                </span>
            </span>
            <div class="ml-3">
                <div class="font-medium text-gray-700 group-hover:text-gray-900">
                    {{ 'Homer' . ' ' . 'Simpson' }}</div>
                <button class="flex items-center text-sm"
                        aria-label="Logout"
                        title="Logout"
                        data-submit="logout-form">
                    <span>Se déconnecter</span>
                    <x-tabler-logout class="ml-1 h-5" />
                </button>
            </div>
        </div>
    </div>
</div>
