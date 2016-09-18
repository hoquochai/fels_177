@if (session('message'))
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="glyphicon glyphicon-info-sign"></span> {{ session('message') }}</br>
    </div>
@endif
