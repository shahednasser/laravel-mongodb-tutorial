<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 bg-white border-b border-gray-200">
      <h1 class="text-xl md:text-2xl">{{ $post['title']}}</h1>
      <p class="my-2">{{ $post['content'] }}</p>
      <small class="text-gray-500">{{ $post['user']['name'] }} - {{ $post['created_at'] }}</small>
      @if(\Auth::user()->_id === $post['user']['_id'])
        <a href="{{ route('post.edit.form', ['id' => $post['_id']]) }}" class="inline-block align-middle pb-1 text-decoration-none text-gray-600">
          @component('components.edit')
          @endcomponent
        </a>
        <form method="POST" action="{{ route('post.delete') }}" class="inline-block align-middle">
          @csrf
          <input type="hidden" name="id" value="{{ $post['_id'] }}" />
          <button type="submit" class="border-0 bg-transparent text-red-400">
            @component('components.delete')
            @endcomponent
          </button>
        </form>
      @endif
  </div>
</div>