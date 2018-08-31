@extends('layouts.master')

@section('content')
  <h1 class="page-header">Dashboard</h1>

  <div class="form-container">
    <form class="form-horizontal">

      <div class="form-group">
        <label for="inputText3" class="col-sm-2 control-label">Text</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputText3" placeholder="Text input">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <label for="inputSelect3" class="col-sm-2 control-label">Select</label>
        <div class="col-sm-10">
          <select class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputCheckbox3" class="col-sm-2 control-label">Checkbox</label>
        <div class="col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox" value="">
              Option one is this and that&mdash;be sure to include why it's great
            </label>
            <label>
              <input type="checkbox" value="">
              Option one is this and that&mdash;be sure to include why it's great
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputRadio3" class="col-sm-2 control-label">Radio</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
              Option one is this and that&mdash;be sure to include why it's great
            </label>
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" checked>
              Option one is this and that&mdash;be sure to include why it's great
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputTextarea3" class="col-sm-2 control-label">Textarea</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="inputTextarea3" rows="3"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Sign in</button>
        </div>
      </div>
    </form>
  </div>


  <div class="form-container">
    <form action="" method="POST" id="" class="form-horizontal">

      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Label Name</label>
        <div class="col-sm-10">
          <div class="input-group">
            <select class="form-control" name="" id="1">
                <option value=""> Option One</option>
                <option value=""> Option Two</option>
                <option value=""> Option Three</option>
            </select>
            <div class="input-group-addon">
              <span data-toggle="modal" data-target=""><i class="fa fa-plus"></i></span>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Label Name</label>
        <div class="col-sm-10">
          <div class="input-group">
          <div class="input-group-addon iconfirst">
            <span data-toggle="modal" data-target=""><i class="fa fa-calendar"></i></span>
          </div>
            <select class="form-control" name="" id="2">
                <option value=""> Option One</option>
                <option value=""> Option Two</option>
                <option value=""> Option Three</option>
            </select>
          </div>
        </div>
      </div>

    </form>
  </div>

  <div class="table-responsive table-container">
    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>SL.</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1,001</td>
          <td>Lorem</td>
          <td>ipsum</td>
          <td>dolor</td>
          <td>sit</td>
        </tr>
        <tr>
          <td>1,002</td>
          <td>amet</td>
          <td>consectetur</td>
          <td>adipiscing</td>
          <td>elit</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>Integer</td>
          <td>nec</td>
          <td>odio</td>
          <td>Praesent</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>libero</td>
          <td>Sed</td>
          <td>cursus</td>
          <td>ante</td>
        </tr>
        <tr>
          <td>1,004</td>
          <td>dapibus</td>
          <td>diam</td>
          <td>Sed</td>
          <td>nisi</td>
        </tr>
        <tr>
          <td>1,005</td>
          <td>Nulla</td>
          <td>quis</td>
          <td>sem</td>
          <td>at</td>
        </tr>
        <tr>
          <td>1,006</td>
          <td>nibh</td>
          <td>elementum</td>
          <td>imperdiet</td>
          <td>Duis</td>
        </tr>
        <tr>
          <td>1,007</td>
          <td>sagittis</td>
          <td>ipsum</td>
          <td>Praesent</td>
          <td>mauris</td>
        </tr>
        <tr>
          <td>1,008</td>
          <td>Fusce</td>
          <td>nec</td>
          <td>tellus</td>
          <td>sed</td>
        </tr>
        <tr>
          <td>1,009</td>
          <td>augue</td>
          <td>semper</td>
          <td>porta</td>
          <td>Mauris</td>
        </tr>
        <tr>
          <td>1,010</td>
          <td>massa</td>
          <td>Vestibulum</td>
          <td>lacinia</td>
          <td>arcu</td>
        </tr>
        <tr>
          <td>1,011</td>
          <td>eget</td>
          <td>nulla</td>
          <td>Class</td>
          <td>aptent</td>
        </tr>
        <tr>
          <td>1,012</td>
          <td>taciti</td>
          <td>sociosqu</td>
          <td>ad</td>
          <td>litora</td>
        </tr>
        <tr>
          <td>1,013</td>
          <td>torquent</td>
          <td>per</td>
          <td>conubia</td>
          <td>nostra</td>
        </tr>
        <tr>
          <td>1,014</td>
          <td>per</td>
          <td>inceptos</td>
          <td>himenaeos</td>
          <td>Curabitur</td>
        </tr>
        <tr>
          <td>1,015</td>
          <td>sodales</td>
          <td>ligula</td>
          <td>in</td>
          <td>libero</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
