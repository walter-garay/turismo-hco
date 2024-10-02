<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>


    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $user->nombre)" required autofocus autocomplete="nombre" />
            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Celular -->
        <div>
            <x-input-label for="celular" :value="__('Celular')" />
            <x-text-input id="celular" name="celular" type="text" class="mt-1 block w-full" :value="old('celular', $user->celular)" autocomplete="celular" />
            <x-input-error class="mt-2" :messages="$errors->get('celular')" />
        </div>

        <!-- DNI -->
        <div>
            <x-input-label for="dni" :value="__('DNI')" />
            <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full" :value="old('dni', $user->dni)" autocomplete="dni" />
            <x-input-error class="mt-2" :messages="$errors->get('dni')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
