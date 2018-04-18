@extends('main')
@section ('title', '| Contact')
@section('content')

<div class="container">
            <div class="row">
                <br>
              
                <div class="col-md-8 col-md-offset-2 ">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center contact-panel-heading" >
                            <img class="img img-responsive img-panel " src ="{{ '/images/pages/contact.png' }}"  width ="100%"></img>
					
                        </div>
						<form action="{{ url('contact') }}" method="POST">
							{{ csrf_field() }}
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
										<input type="text" name="name" placeholder="Nom" class="form-control" autofocus="autofocus" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope blue"></i></span>
										<input type="email" name="email" placeholder="Email" class="form-control" required>
									</div>
								</div>
							   
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-comment blue"></i></span>
										<textarea name="msg" rows="6" class="form-control" type="text" required></textarea>
									</div>
								</div>
								<div class="">
								<button type="submit" class="btn btn-info ">Envoyer <span class="glyphicon glyphicon-send"></span></button>
								</div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
        
@endsection
