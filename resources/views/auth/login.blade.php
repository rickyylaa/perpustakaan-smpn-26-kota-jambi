<x-auth-layout>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h1">
                <b>SMPN 26<br>Kota Jambi</b>
            </a>
        </div>
        <div class="card-body login-card-body">
            <form method="POST" action="{{ $route }}">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="input-group">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-solid fa-sharp fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('username') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" class="input-group-text toggle-password" data-target="password">
                                    <span class="fa fa-solid fa-sharp fa-lock"></span>
                                </button>
                            </div>
                        </div>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember"> Ingatkan saya! </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts-guest>
