@if($allCategories->isEmpty())
    <p>{{__('Нет ни одной категории')}}</p>
@else
    <div class="row">
        <ul>
        @foreach($allCategories as $post)
              @if($post->active === 1)
                    <li>
                        <h2 class="h5 mb-2">

                            <a href="{{ route(session('session_admin')?'admin.categories.show':(session('session_user')?'auth.categories.show': 'categories.show'), $post->url) }}">{{ $post->name }}</a>
                        </h2>
                    </li>
              @endif
        @endforeach
        </ul>
    </div>
@endif

