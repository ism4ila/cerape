@extends('layouts.admin')

@section('header', 'Configuration du site')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row g-4">
                <div class="col-12">
                    <h5 class="fw-bold mb-0">Identite visuelle</h5>
                </div>

                <div class="col-md-6">
                    <label for="site_name" class="form-label fw-semibold">Nom du site</label>
                    <input type="text" id="site_name" name="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $siteSettings['site_name']) }}" aria-describedby="site_name-error" aria-invalid="{{ $errors->has('site_name') ? 'true' : 'false' }}">
                    @error('site_name') <p id="site_name-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6">
                    <label for="site_tagline" class="form-label fw-semibold">Slogan</label>
                    <input type="text" id="site_tagline" name="site_tagline" class="form-control @error('site_tagline') is-invalid @enderror" value="{{ old('site_tagline', $siteSettings['site_tagline']) }}" aria-describedby="site_tagline-error" aria-invalid="{{ $errors->has('site_tagline') ? 'true' : 'false' }}">
                    @error('site_tagline') <p id="site_tagline-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-12">
                    <label for="site_description" class="form-label fw-semibold">Description</label>
                    <textarea id="site_description" name="site_description" rows="3" class="form-control @error('site_description') is-invalid @enderror" aria-describedby="site_description-error" aria-invalid="{{ $errors->has('site_description') ? 'true' : 'false' }}">{{ old('site_description', $siteSettings['site_description']) }}</textarea>
                    @error('site_description') <p id="site_description-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6">
                    <label for="logo" class="form-label fw-semibold">Logo</label>
                    <input type="file" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*" aria-describedby="logo-error" aria-invalid="{{ $errors->has('logo') ? 'true' : 'false' }}">
                    @error('logo') <p id="logo-error" class="invalid-feedback">{{ $message }}</p> @enderror
                    @if(!empty($siteSettings['logo']))
                        <small class="text-muted d-block mt-2">Logo actuel:</small>
                        <img src="{{ \Illuminate\Support\Str::startsWith($siteSettings['logo'], ['http://', 'https://']) ? $siteSettings['logo'] : \Illuminate\Support\Facades\Storage::url($siteSettings['logo']) }}" alt="Logo actuel" style="max-height: 48px;">
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="favicon" class="form-label fw-semibold">Favicon</label>
                    <input type="file" id="favicon" name="favicon" class="form-control @error('favicon') is-invalid @enderror" accept="image/*" aria-describedby="favicon-error" aria-invalid="{{ $errors->has('favicon') ? 'true' : 'false' }}">
                    @error('favicon') <p id="favicon-error" class="invalid-feedback">{{ $message }}</p> @enderror
                    @if(!empty($siteSettings['favicon']))
                        <small class="text-muted d-block mt-2">Favicon actuel:</small>
                        <img src="{{ \Illuminate\Support\Str::startsWith($siteSettings['favicon'], ['http://', 'https://']) ? $siteSettings['favicon'] : \Illuminate\Support\Facades\Storage::url($siteSettings['favicon']) }}" alt="Favicon actuel" style="max-height: 32px;">
                    @endif
                </div>

                <div class="col-md-4">
                    <label for="theme_primary_color" class="form-label fw-semibold">Couleur principale</label>
                    <input type="color" id="theme_primary_color" name="theme_primary_color" class="form-control form-control-color @error('theme_primary_color') is-invalid @enderror" value="{{ old('theme_primary_color', $siteSettings['theme_primary_color']) }}" aria-describedby="theme_primary_color-error" aria-invalid="{{ $errors->has('theme_primary_color') ? 'true' : 'false' }}">
                    @error('theme_primary_color') <p id="theme_primary_color-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold mb-0">Coordonnees</h5>
                </div>

                <div class="col-md-6">
                    <label for="contact_email" class="form-label fw-semibold">Email</label>
                    <input type="email" id="contact_email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email', $siteSettings['contact_email']) }}" aria-describedby="contact_email-error" aria-invalid="{{ $errors->has('contact_email') ? 'true' : 'false' }}">
                    @error('contact_email') <p id="contact_email-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6">
                    <label for="contact_phone" class="form-label fw-semibold">Telephone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" value="{{ old('contact_phone', $siteSettings['contact_phone']) }}" pattern="[+0-9\s\-]{7,15}" aria-describedby="contact_phone-error" aria-invalid="{{ $errors->has('contact_phone') ? 'true' : 'false' }}">
                    @error('contact_phone') <p id="contact_phone-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-12">
                    <label for="contact_address" class="form-label fw-semibold">Adresse</label>
                    <textarea id="contact_address" name="contact_address" rows="2" class="form-control @error('contact_address') is-invalid @enderror" aria-describedby="contact_address-error" aria-invalid="{{ $errors->has('contact_address') ? 'true' : 'false' }}">{{ old('contact_address', $siteSettings['contact_address']) }}</textarea>
                    @error('contact_address') <p id="contact_address-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold mb-0">Reseaux sociaux</h5>
                </div>

                <div class="col-md-6">
                    <label for="facebook_url" class="form-label fw-semibold">Facebook URL</label>
                    <input type="url" id="facebook_url" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $siteSettings['facebook_url']) }}" aria-describedby="facebook_url-error" aria-invalid="{{ $errors->has('facebook_url') ? 'true' : 'false' }}">
                    @error('facebook_url') <p id="facebook_url-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6">
                    <label for="twitter_url" class="form-label fw-semibold">Twitter URL</label>
                    <input type="url" id="twitter_url" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url', $siteSettings['twitter_url']) }}" aria-describedby="twitter_url-error" aria-invalid="{{ $errors->has('twitter_url') ? 'true' : 'false' }}">
                    @error('twitter_url') <p id="twitter_url-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6">
                    <label for="instagram_url" class="form-label fw-semibold">Instagram URL</label>
                    <input type="url" id="instagram_url" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $siteSettings['instagram_url']) }}" aria-describedby="instagram_url-error" aria-invalid="{{ $errors->has('instagram_url') ? 'true' : 'false' }}">
                    @error('instagram_url') <p id="instagram_url-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6">
                    <label for="whatsapp_url" class="form-label fw-semibold">WhatsApp URL</label>
                    <input type="url" id="whatsapp_url" name="whatsapp_url" class="form-control @error('whatsapp_url') is-invalid @enderror" value="{{ old('whatsapp_url', $siteSettings['whatsapp_url']) }}" aria-describedby="whatsapp_url-error" aria-invalid="{{ $errors->has('whatsapp_url') ? 'true' : 'false' }}">
                    @error('whatsapp_url') <p id="whatsapp_url-error" class="invalid-feedback">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
