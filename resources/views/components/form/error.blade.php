@if ($errors->has($name))
  <div class="text-danger mb-2 w-100">
    @foreach ($errors->get($name) as $error)
      <div>{{ $error }}</div>
    @endforeach
  </div>
@endif
