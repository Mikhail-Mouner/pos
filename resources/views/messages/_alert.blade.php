@if (session()->has('success'))
    <div class="alert alert-success">
        <h5 class="text-capitalize text-center">
            {{ session()->get('success') }}
        </h5>
    </div>
@elseif(session()->has('danger'))
    <div class="alert alert-danger">
        <h5 class="text-capitalize text-center">
            {{ session()->get('danger') }}
        </h5>
    </div>
@endif
<!-- Create Post Form -->
