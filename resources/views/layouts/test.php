<div class = "col-12 col-sm-10 col-md-9 col-lg-8 col-xxl-6 mx-auto">
   <h1 class = "text-center fs-2">Rejestracja</h1>
   <form method="post" action="{{ route('register') }}">
      @csrf
      <div class="form-group">
         <label for="name">Imię:</label><br>
         <input type="text" id="name" name="name" value = "{{ old('name') }}" class="form-control">
         @component('components.form.error', ['name' => 'name'])@endcomponent
      </div>
      <div class="form-group">
         <label for="email">E-mail:</label><br>
         <input type="text" id="email" name="email" value = "{{ old('email') }}" class="form-control">
         @component('components.form.error', ['name' => 'email'])@endcomponent
      </div>
      <div class="form-group">
         <label for="password">Hasło:</label><br>
         <input type="password" id="password" name="password" class="form-control">
         @component('components.form.error', ['name' => 'password'])@endcomponent
      </div>
      <div class="mt-2">
         <input type="submit" value="Utwórz nowego użytkownika" class="btn btn-primary w-100">
      </div>
   </form>
</div>
