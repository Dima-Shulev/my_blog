@if($allReviews->isEmpty())
    <p>{{__('Нет ни одного отзыва')}}</p>
@else
    <div class="row">

        @foreach($allReviews as $post)

            @if($post->status === 1)
                <div class="form-control mb-3">
                    <x-form-item>
                        <h2 class="h5">
                            <a href="{{ route((session('session_user') === 'session_auth') && (session('session_status') !== 'session_admin')?'auth.reviews.show':'reviews.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                    </x-form-item>

                    <x-form-item>
                        <p><b>{{ $post->created_at }}</b></p>
                    </x-form-item>

                    <x-form-item >
                        <a href="{{ route((session('session_user') === 'session_auth') && (session('session_status') !== 'session_admin')?'auth.reviews.show':'reviews.show', $post->id) }}" class="btn btn-primary">{{__('Подробнее...')}}</a>
                    </x-form-item>
                </div>
            @endif
        @endforeach

    </div>
@endif
