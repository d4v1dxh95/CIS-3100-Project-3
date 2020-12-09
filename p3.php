<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <meta charset="UTF-8">
  <title>PC Parts</title>
  <style>
    input[type='submit'], button, [aria-label]{
      cursor: pointer;
    }
    #spoiler{
      display: none;
    }
  </style>
</head>
<body>

<form action="javascript:void(0);" method="POST" onsubmit="app.Add()"> 
  <input type="text" id="add-name" placeholder="New parts">
  <input type="submit" value="Add">
</form>

<div id="spoiler" role="aria-hidden">
  <form action="javascript:void(0);" method="POST" id="saveEdit">
    <input type="text" id="edit-name">
    <input type="submit" value="Edit" /> <a onclick="CloseInput()" aria-label="Close">&#10006;</a>
  </form>
</div>

<p id="counter"></p>

<table>
  <tr>
    <th>Name</th>
  </tr>
    <tbody id="parts">
    </tbody>
</table>

<script>
var app = new function() {

  this.el = document.getElementById('parts');

  this.parts = ['GPU', 'CPU', 'RAM', 'Motherboard', 'Memory', 'Peripherals', 'Fan Controllers', ];

  this.Count = function(data) {
    var el   = document.getElementById('counter');
    var name = 'parts';

    if (data) {
      if (data > 1) {
        name = 'parts';
      }
      el.innerHTML = data + ' ' + name ;
    } else {
      el.innerHTML = 'No ' + name;
    }
  };
  
  this.FetchAll = function() {
    var data = '';

    if (this.parts.length > 0) {
      for (i = 0; i < this.parts.length; i++) {
        data += '<tr>';
        data += '<td>' + this.parts[i] + '</td>';
        data += '<td><button onclick="app.Edit(' + i + ')">Edit</button></td>';
        data += '<td><button onclick="app.Delete(' + i + ')">Delete</button></td>';
        data += '</tr>';
      }
    }

    this.Count(this.parts.length);
    return this.el.innerHTML = data;
  };

  this.Add = function () {
    el = document.getElementById('add-name');
    // Get the value
    var parts = el.value;

    if (parts) {
      // Add the new value
      this.parts.push(parts.trim());
      // Reset input value
      el.value = '';
      // Dislay the new list
      this.FetchAll();
    }
  };

  this.Edit = function (item) {
    var el = document.getElementById('edit-name');
    // Display value in the field
    el.value = this.parts[item];
    // Display fields
    document.getElementById('spoiler').style.display = 'block';
    self = this;

    document.getElementById('saveEdit').onsubmit = function() {
      // Get value
      var parts = el.value;

      if (parts) {
        // Edit value
        self.parts.splice(item, 1, parts.trim());
        // Display the new list
        self.FetchAll();
        // Hide fields
        CloseInput();
      }
    }
  };

  this.Delete = function (item) {
    // Delete the current row
    this.parts.splice(item, 1);
    // Display the new list
    this.FetchAll();
  };
  
}

app.FetchAll();

function CloseInput() {
  document.getElementById('spoiler').style.display = 'none';
}
</script>
</body>
</html>