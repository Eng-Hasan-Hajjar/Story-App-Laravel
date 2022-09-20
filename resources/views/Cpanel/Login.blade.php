@extends('layout.master')

@section('Content')

    <div class="container">
        <h4 class="text-center">Cpanel Login Form</h4>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form action="{{ route('CpanelLoginPost') }}" method="post">

                    <div class="form-group">
                        <input type="text" name="UserNameI" placeholder="Username Input"  class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="text" name="PasswordI" placeholder="Password Input"  class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Login"   class="btn btn-primary btn-block">
                    </div>
                    
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

    </div>
    
@endsection