<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Api center</title>
  </head>
  <style media="screen">
    button{
    }
  </style>
  <body>
    <button type="button" class="btn btn-primary"style="width:100%;" data-toggle="modal" data-target="#exampleModal">Add api</button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Api</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Api Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Api Name">
          </div>

            <div class="form-group">
            <label >Request Parameter</label>
            <textarea row="4"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Request Parameter"></textarea>
          </div>
            <div class="form-group">
            <label for="">Api url</label>
            <textarea row="4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Api url"></textarea>
          </div>
            <div class="form-group">
            <label for="">Api response</label>
            <textarea row="4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Api response"></textarea>
          </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>




    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Api edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Api Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Api Name">
          </div>

            <div class="form-group">
            <label >Request Parameter</label>
            <textarea row="4"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Request Parameter"></textarea>
          </div>
            <div class="form-group">
            <label for="">Api url</label>
            <textarea row="4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Api url"></textarea>
          </div>
            <div class="form-group">
            <label for="">Api response</label>
            <textarea row="4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Api response"></textarea>
          </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <table style="width:100%;">
    <tr>
    <td width="80%"><div  style="margin:0px; text-align:center;" role="alert"><strong>Login Request</strong></div></td><td style="text-align:right;"><div  style="margin:0px;" role="alert" ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">Edit</button></div></td><td style="text-align:left;"><div  style="margin:0px;" role="alert"><button type="button" class="btn btn-danger">Delete</button></div></td>
    </tr>
    <tr>
    <td width="80%" colspan="3"><div class="alert alert-dark"style="margin:0px;" role="alert"><strong>Request parameter :</strong></div></td>
    </tr>
    <tr>
    <td width="80%" colspan="3"><div class="alert alert-dark"style="margin:0px;" role="alert"><strong>Request Url :</strong></div></td>
    </tr>
    <tr>
    <td width="80%" colspan="3"><div class="alert alert-dark"style="margin:0px;" role="alert"><strong>Response value :</strong></div></td>
    </tr>
    </table>
    <hr>













    <table style="width:100%;">
    <tr>
    <td width="80%"><div  style="margin:0px; text-align:center;" role="alert"><strong>Login Request</strong></div></td><td style="text-align:right;"><div  style="margin:0px;" role="alert" ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">Edit</button></div></td><td style="text-align:left;"><div  style="margin:0px;" role="alert"><button type="button" class="btn btn-danger">Delete</button></div></td>
    </tr>
    <tr>
    <td width="80%" colspan="3"><div class="alert alert-dark"style="margin:0px;" role="alert"><strong>Request parameter :</strong></div></td>
    </tr>
    <tr>
    <td width="80%" colspan="3"><div class="alert alert-dark"style="margin:0px;" role="alert"><strong>Request Url :</strong></div></td>
    </tr>
    <tr>
    <td width="80%" colspan="3"><div class="alert alert-dark"style="margin:0px;" role="alert"><strong>Response value :</strong></div></td>
    </tr>
    </table>
    <hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<!-- Button trigger modal -->
