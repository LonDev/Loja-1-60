@extends('app')
@section('content')
<link rel="stylesheet" type="text/css" href="<% asset('css/login.css') %>">
<div class="container-fluid">
    
            <div class="cold-md-4 corpo">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<% url('/login') %>">
                        <!! csrf_field() !!>

                        <div class="form-group <% $errors->has('nome') ? ' has-error' : '' %>">
                            <label class="col-md-2">Nome</label>
                            
                            <div class="col-md-10">

                                <input type="nome" class="form-control" name="nome" value="<% old('nome') %>">
                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong><% $errors->first('nome') %></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group<% $errors->has('senha') ? ' has-error' : '' %>">
                            <label class="col-md-2">Senha</label>

                            <div class="col-md-10">
                                <input type="password" class="form-control" name="senha">

                                @if ($errors->has('senha'))
                                    <span class="help-block">
                                        <strong><% $errors->first('senha') %></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-2 checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Lembrar
                                </label>
                            </div>

                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>
                            </div>
                        
                        </div>
                    </form>

                </div>
            </div>
</div>
@endsection
