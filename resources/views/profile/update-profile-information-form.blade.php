<x-card.form>
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>


    <form wire:submit.prevent="updateProfileInformation">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <div class="mt-4 flex mb-4">
                    <x-button.secondary type="button" x-on:click.prevent="$refs.photo.click()">
                        Select A New Photo
                    </x-button.secondary>
                    <div class="ml-2">
                        @if ($this->user->profile_photo_path)
                            <x-button.error type="button" wire:click="deleteProfilePhoto">
                                Remove Photo
                            </x-button.error>
                        @endif
                    </div>
                </div>


                <x-input.error for="photo" />
            </div>
        @endif

        <x-input.wrapper>
            <x-input.label for="name" value="{{ __('Name') }}" />
            <x-input.text id="name" value="{{ $state['name'] }}" type="text" autocomplete="name" disabled />
            <x-input.error for="name" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="email" value="{{ __('Email') }}" />
            <x-input.text id="email" value="{{ $state['email'] }}" type="email" disabled />
            <x-input.error for="email" />
        </x-input.wrapper>

        <div class="flex justify-end mt-6 items-center">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-button.black type="submit" wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>
