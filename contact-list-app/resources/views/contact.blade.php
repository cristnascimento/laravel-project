@extends("master")

@section("content")
    <div class="container col-md-6" >
    <br/>
    <h3>{{ $title }}</h3><br/>
    @if ($mode == "add")
        <form method="POST" action="/users/add/post">
    @elseif ($mode == "edit")
        <form method="POST" action="/users/update/{{ $contact->id }}">
    @else
        <form>
    @endif
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $contact->firstName }}" {{ $mode == "view" ? "readonly" : "" }}>
        </div>
        <div class="form-group col-md-6">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $contact->lastName }}" {{ $mode == "view" ? "readonly" : "" }}>
        </div>
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" {{ $mode == "view" ? "readonly" : "" }}>
      </div>
      <div class="form-row">
        <div class="form-group col-md-8">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}" {{ $mode == "view" ? "readonly" : "" }}>
        </div>
        <div class="form-group col-md-4">
          <label for="phoneCategory">Category</label>
          <select id="phoneCategory" name="phoneCategory" class="form-control" {{ $mode == "view" ? "disabled" : "" }}>
            <option {{ $contact->phoneCategory == "Mobile" ? "selected" : "" }}>Mobile</option>
            <option {{ $contact->phoneCategory == "Home" ? "selected" : "" }}>Home</option>
            <option {{ $contact->phoneCategory == "Work" ? "selected" : "" }}>Work</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="1234 main st" value="{{ $contact->address }}" {{ $mode == "view" ? "readonly" : "" }}>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="city">City</label>
          <input type="text" class="form-control" id="city" name="city" value="{{ $contact->city }}" {{ $mode == "view" ? "readonly" : "" }}>
        </div>
        <div class="form-group col-md-4">
          <label for="state">State</label>
          <select id="state" name="state" class="form-control" {{ $mode == "view" ? "disabled" : "" }}>
            <option {{ $contact->state == "AC" ? "selected" : "" }}>AC</option>
            <option {{ $contact->state == "AL" ? "selected" : "" }}>AL</option>
            <option {{ $contact->state == "AP" ? "selected" : "" }}>AP</option>
            <option {{ $contact->state == "AM" ? "selected" : "" }}>AM</option>
            <option {{ $contact->state == "BA" ? "selected" : "" }}>BA</option>
            <option {{ $contact->state == "CE" ? "selected" : "" }}>CE</option>
            <option {{ $contact->state == "DF" ? "selected" : "" }}>DF</option>
            <option {{ $contact->state == "ES" ? "selected" : "" }}>ES</option>
            <option {{ $contact->state == "GO" ? "selected" : "" }}>GO</option>
            <option {{ $contact->state == "MA" ? "selected" : "" }}>MA</option>
            <option {{ $contact->state == "MT" ? "selected" : "" }}>MT</option>
            <option {{ $contact->state == "MS" ? "selected" : "" }}>MS</option>
            <option {{ $contact->state == "MG" ? "selected" : "" }}>MG</option>
            <option {{ $contact->state == "PA" ? "selected" : "" }}>PA</option>
            <option {{ $contact->state == "PB" ? "selected" : "" }}>PB</option>
            <option {{ $contact->state == "PR" ? "selected" : "" }}>PR</option>
            <option {{ $contact->state == "PE" ? "selected" : "" }}>PE</option>
            <option {{ $contact->state == "PI" ? "selected" : "" }}>PI</option>
            <option {{ $contact->state == "RJ" ? "selected" : "" }}>RJ</option>
            <option {{ $contact->state == "RN" ? "selected" : "" }}>RN</option>
            <option {{ $contact->state == "RS" ? "selected" : "" }}>RS</option>
            <option {{ $contact->state == "RO" ? "selected" : "" }}>RO</option>
            <option {{ $contact->state == "RR" ? "selected" : "" }}>RR</option>
            <option {{ $contact->state == "SC" ? "selected" : "" }}>SC</option>
            <option {{ $contact->state == "SP" ? "selected" : "" }}>SP</option>
            <option {{ $contact->state == "SE" ? "selected" : "" }}>SE</option>
            <option {{ $contact->state == "TO" ? "selected" : "" }}>TO</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="zip">Zip</label>
          <input type="text" class="form-control" id="zip" name="zip" value="{{ $contact->zip }}" {{ $mode == "view" ? "readonly" : "" }}>
        </div>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="closeFriend" name="closeFriend" {{ $contact->closeFriend == "on" ? "checked" : "" }} {{ $mode == "view" ? "disabled" : "" }}>
          <label class="form-check-label" for="closeFriend">
            Close friend
          </label>
        </div>
      </div>
    @if ($mode == "add")
      <button type="submit" class="btn btn-primary">Add</button>
      <a class="btn btn-warning" href="/">Cancel</a>
    @elseif ($mode == "edit")
      <button type="submit" class="btn btn-primary">Update</button>
      <a class="btn btn-warning" href="/users/list">Cancel</a>
    @else
      <a class="btn btn-primary" href="/users/edit/{{ $contact->id }}">Edit</a>
      <a class="btn btn-warning" href="/users/list">Go back</a>
    @endif
    </form>
    </div>
    </div>
@endsection
