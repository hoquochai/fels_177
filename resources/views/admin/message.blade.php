@if (session('message'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="glyphicon glyphicon-ok"></span> {{ session('message') }}</br>
    </div>
@endif
