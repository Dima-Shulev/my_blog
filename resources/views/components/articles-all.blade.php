@if($allArticles->isEmpty())
    <p>{{__('Нет ни одной статьи')}}</p>
@else
    <div class="row">
        @foreach($allArticles as $post)
            @if($post->active === 1)
                    <x-form-item>
                        <h2 class="h5">
                            <a href="{{ route( (session('session_admin')?'admin.articles.show':(session('session_user')?'auth.articles.show': 'articles.show')) ,$post->url) }}">{{ $post->title }}</a>
                        </h2>
                    </x-form-item>
            @endif
        @endforeach
    </div>
@endif
