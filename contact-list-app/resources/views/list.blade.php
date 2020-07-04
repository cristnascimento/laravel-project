@extends("master")

@section("content")
    <div class="container col-md-8" >
        <br/>
        <h3>List of users</h3><br/>
            <table class="table table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                    @php
                        $rowCounter = 1;
                    @endphp
                    @foreach($contacts as $contact)
                        <tr>
                          <th scope="row">{{ $rowCounter }}</th>
                          <td>{{ $contact->firstName }}</td>
                          <td>{{ $contact->lastName }}</td>
                          <td>{{ $contact->email }}</td>
                          <td>
                            <a class="btn btn-success" href="/users/view/{{ $contact->id }}" role="button">View</a>
                            <a class="btn btn-warning" href="/users/edit/{{ $contact->id }}" role="button">Edit</a>
                            <a class="btn btn-danger" href="/users/delete/{{ $contact->id }}" role="button">Remove</a>
                          </td>
                        </tr>
                        @php
                            $rowCounter += 1;
                        @endphp
                    @endforeach
              </tbody>
            </table>
    </div>
@endsection
