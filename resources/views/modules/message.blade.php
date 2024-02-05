@if(session('success'))
    <x-container>
        <x-message.success-user class="alert alert-success">
            {{ session('success') }}
        </x-message.success-user>
    </x-container>
@elseif(session('error'))
    <x-container>
        <x-message.errors-user class="alert alert-danger">
            {{ session('error') }}
        </x-message.errors-user>
    </x-container>
@endif
