<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"/>

        <script type="text/javascript">
            function validateForm()
            { 
                $(".text-danger").html('');
                debugger;
                var error = true;
                var errorInput;
                var author = document.forms["BookForm"]["author"];
                var title = document.forms["BookForm"]["title"];
                var genre = document.forms["BookForm"]["genre"];
                var price = document.forms["BookForm"]["price"];
                var publisheddate = document.forms["BookForm"]["publisheddate"];
                var description = document.forms["BookForm"]["description"];

                if (author.value == "")                                  
                { 
                    $("#author_err").html('Please enter book author.');
                    errorInput = author;
                    error= false; 
                }
                if (title.value == "")    
                { 
                    $("#title_err").html('Please choose book title.');
                    errorInput = title; 
                    error= false; 
                }
                if (genre.value == "")    
                { 
                    $("#genre_err").html('Please choose book genre.');
                    errorInput = genre; 
                    error= false; 
                }
                if (price.value == "")    
                { 
                    $("#price_err").html('Please choose book price.');
                    errorInput = price; 
                    error= false; 
                }
                if (publisheddate.value == "")    
                { 
                    $("#publisheddate_err").html('Please choose book publisheddate.');
                    errorInput = publisheddate; 
                    error= false; 
                }
                if (description.value == "")    
                { 
                    $("#description_err").html('Please choose book description.');
                    errorInput = description; 
                    error= false; 
                }
                if (!error) {
                    errorInput.focus();
                }
                return error;
            }
            $(function () {
                $('#startdate_datepicker').datepicker();
            });
        </script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php if (isset($update)) { ?>
        <div id="container">
            <div class="row ml-5">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="mb-2 p-2">
                        <a href="<?php echo base_url() ."/view"; ?>">« Back to View Book </a>
                    </div>
                    <form method="POST" action="<?php echo base_url() ."/update"; ?>" name="BookForm" onSubmit="return validateForm(this);">
                        <input type="hidden" name="hidden_id" value="<?php echo isset($update['@attributes']['id']) ? $update['@attributes']['id'] : ''; ?>">

                        <div class="form-group row">
                            <label for="author" class="col-sm-2 col-form-label">Author</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="author" id="author" placeholder="Enter book author" autocomplete="off" value="<?php echo isset($update['author']) ? $update['author'] : ''; ?>">
                                <span id="author_err" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter book title" autocomplete="off" value="<?php echo isset($update['title']) ? $update['title'] : ''; ?>">
                                <span id="title_err" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="genre" id="genre" placeholder="Enter book genre" autocomplete="off" value="<?php echo isset($update['genre']) ? $update['genre'] : ''; ?>">
                                <span id="genre_err" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="price" id="price" placeholder="Enter book price" autocomplete="off" value="<?php echo isset($update['price']) ? $update['price'] : ''; ?>">
                                <span id="price_err" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Published Date</label>
                            <div class="start_date input-group col-sm-5">
                                <input class="form-control start_date" type="text" placeholder="Enter book publish date" id="startdate_datepicker" name="publisheddate">
                                <div class="input-group-append">
                                <span class="fa fa-calendar input-group-text start_date_calendar" aria-hidden="true "></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter book description" autocomplete="off" value="<?php echo isset($update['description']) ? $update['description'] : ''; ?>">
                                <span id="description_err" class="text-danger"></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (isset($data)) { ?>
            <div id="container">
                <div class="row">
                    <h2 class="text-primary p-2 ml-3">Manage Books</h2>
                    <div class="float-right p-2">
                        <a href="<?php echo base_url() ."/create"; ?>" class="btn btn-primary btn-sm m-2">Add Book</a>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Author</th>
                        <th scope="col">Title</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Price</th>
                        <th scope="col">Publised Date</th>
                        <th scope="col" class="w-50">Description</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data) {
                            foreach ($data as $k => $data_item) {
                        ?>
                        <tr>
                            <td><?php echo $k; ?></td>
                            <td><?php echo $data_item['author']; ?></td>
                            <td><?php echo $data_item['title'] ?></td>
                            <td><?php echo $data_item['genre'] ?></td>
                            <td><?php echo $data_item['price'] ?></td>
                            <td><?php echo $data_item['publish_date'] ?></td>
                            <td><?php echo $data_item['description'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-success"
                                href="<?php echo base_url() ."/edit/"; ?><?php echo $k; ?>">
                                Edit
                                </a>
                                <a class="btn btn-sm btn-danger" 
                                href="<?php echo base_url() ."/delete/"; ?><?php echo $k; ?>">
                                Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan=5>No Record Found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        
        <script src="" async defer></script>
        <script>
            function confirmDelete() {
                if (confirm('Are you sure you want to delete this record')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>