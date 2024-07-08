<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        <i class="fas fa-user-circle fa-3x"></i>
      </a>
      <a href="{{ route('users.cards', ['name' => $user->name]) }}" class="ml-auto btn-sm shadow-none border border-primary p-2 text-dark text-decoration-none"><i class="fas fa-address-card mr-1"></i>{{ $user->name }}のメモカード</a>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-2"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
        >
        </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        {{ $user->name }}
      </a>
    </h2>
  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
      <span class="text-muted">
        {{ $user->count_get_likes }} いいね獲得
      </span>
    </div>
  </div>
</div>
