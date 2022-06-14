<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profil Bilgisi') }}
    </x-slot>
    <x-slot name="description">
        {{ __('Hesabınızın profil bilgilerini ve e-posta adresini güncelleyin.') }}
    </x-slot>
    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->

                <div class="mt-2" x-show="! photoPreview">
                    <img  src="@if($this->user->profile_photo_path !=null) {{ asset('storage/'.$this->user->profile_photo_path )}} @else{{ asset($this->user->profile_photo_url )}}@endif" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>
                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
                <div>
                    <div style="width: 43%;display: inline-block;" class="mt-3">
                        <label for="files" class="hidden btn btn-block btn-sm" style="background-color: #021130; color:white;border-radius: 15px;border:1px solid #021130" >Fotoğraf Seç</label>
                    </div>
                    <input id="files" type="file" class="hidden form-control" style="display: none"
                                wire:model="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />
                    @if ($this->user->profile_photo_path)
                        <div style="display: inline-block" class="mt-3">
                            <x-jet-secondary-button style="display: inline-block ;border-radius: 15px;" type="button" class="" wire:click="deleteProfilePhoto">
                                {{ __('Fotoğrafı Kaldırın') }}
                            </x-jet-secondary-button>
                        </div>
                    @endif
                </div>
                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Ad-Soyad') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Kaydedildi.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Kaydet') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
