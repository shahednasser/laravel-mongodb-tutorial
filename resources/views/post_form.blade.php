<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ isset($post) ? __('Edit Post') : __('Create Post') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('post.save') }}">
              @csrf
              @if (isset($post))
                <input type="hidden" name="id" value="{{ $post->_id }}" />
              @endif
              <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" 
                  :value="old('title') ?: (isset($post) ? $post->title : '')" required autofocus />
              </div>
              <div class="mt-3">
                <x-label for="content" :value="__('Content')" />
                <textarea id="content" name="content" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="5">{{ old('content') ?: (isset($post) ? $post->content : '') }}</textarea>
              </div>
              <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Save') }}
                </x-button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</x-app-layout>
