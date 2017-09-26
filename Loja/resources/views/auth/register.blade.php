@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<% url('/register') %>">
                        <!! csrf_field() !!>

                        <div class="form-group<% $errors->has('nome') ? ' has-error' : '' %>">
                            <label class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nome" value="<% old('nome') %>">

                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong><% $errors->first('nome') %></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--div class="form-group<% $errors->has('email') ? ' has-error' : '' %>">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="<% old('email') %>">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong><% $errors->first('email') %></strong>
                                    </span>
                                @endif
                            </div>
                        </div -->

                        <div class="form-group<% $errors->has('senha') ? ' has-error' : '' %>">
                            <label class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="senha">

                                @if ($errors->has('senha'))
                                    <span class="help-block">
                                        <strong><% $errors->first('senha') %></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group<% $errors->has('senha_confirmation') ? ' has-error' : '' %>">
                            <label class="col-md-4 control-label">Confirmar a Senha</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="senha_confirmation">

                                @if ($errors->has('senha_confirmation'))
                                    <span class="help-block">
                                        <strong><% $errors->first('senha_confirmation') %></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
