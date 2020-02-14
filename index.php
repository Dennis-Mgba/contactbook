<?php
include("database/database.php");
include("http/controller.php");

$sql_read_query = "SELECT * FROM contacts";
$result = $conn->query($sql_read_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <title>Contact Book | Welcome</title>
</head>

<body>

    <?php if (isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
         ?>
    </div>
    <?php  endif?>

<div class="container">
	<div class="row">
    	<div class="col-lg-6">
     		<h1>Contact Book</h1>
    	</div>
		<div class="col-lg-6">

	<!-- Trigger the modal with a button -->
			<a type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#addModal" style=" margin-top: 30px;">Add Contact</a>

	       <!-- Modal -->
			<div id="addModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
	          <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">New Contact</h4>
			      </div>
			      <div class="modal-body">

			     <form method="POST" action="http/controller.php"> <!-- add contact form -->
					<div class="row">
						<div class ="col-lg-12 form-item">
							<label>First Name <input type="text" name="first_name" placeholder="Enter First Name"/></label>
						</div>

						 <div class="col-lg-12 form-item">
							<label>Last Name <input type="text" name="last_name" placeholder="Enter Last Name"/></label>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 form-item">
							<label>Phone Number <input type="text" name="phone_num" placeholder="Enter Phone Number"></label>
						</div>
						<div class="col-lg-4 form-item">
							<label>Email <input type="email" name="email" placeholder="Enter Email"> </label>
						</div>

						<div class="col-lg-6 form-item">
							<label>Contact Group
								<select name="contact_group">
									<option value="Family">Family</option>
									<option value="Friend">Friend</option>
									<option value="Business">Business</option>
								</select>
							</label>
						</div>
					</div>

					<div class="col-lg-12 form-item">
						<label><p>Notes</p><textarea name="notes" placeholder="Enter optional note"></textarea>
						</label>
					</div>
                    <!--modal footer-->
					<div class="modal-footer">
			      	<input name="submit" type="submit" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal" style=" margin-top: 30px;"></input>
			      </div>
                </form> <!--end of form -->
				</div>
			      </div>
			    </div>
			  </div><!--End of modal-->

			</div>
   		 </div>

   		<div class="row">
			<div class="col-lg-12">

				<table class="whole-table">
					<thead class="table-head">
						<tr>
							<th width="180">First Name</th>
                            <th width="180">First Name</th>
							<th width="130">Phone</th>
							<th width="230">Email</th>
							<th width="200">Contact Group</th>
							<th width="250">Note</th>
							<th width="80">Actions</th>
							<th></th>
						</tr>
					</thead>

                    <?php if ($result->num_rows > 0) {
                        // output data of each row
                        while($contact = $result->fetch_assoc()) {
                    ?>
					<tbody>
						<tr>
							<td><?php echo $contact['first_name'] ;?></td>
                            <td><?php echo $contact['last_name'] ;?></td>
							<td><?php echo $contact['phone_num'] ;?></td>
							<td><?php echo $contact['email'] ;?></td>
							<td><?php echo $contact['contact_group'] ;?></td>
							<td><?php echo $contact['notes'] ;?></td>

							<td> <!--Edit button column-->
                                <a type="button" class="btn btn-primary editbtn" data-toggle="modal" data-target="#editModal<?php echo $contact['id'];?>">Edit</a>

                                <!-- Modal -->
                     			<div id="editModal<?php echo $contact['id'];?>" class="modal fade" role="dialog">
                     			  <div class="modal-dialog">
                     	          <!-- Modal content-->
                     			    <div class="modal-content">
                     			      <div class="modal-header">
                     			        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     			        <h4 class="modal-title">Update Contact</h4>
                     			      </div>
                     			      <div class="modal-body">

                                          <form method="POST" action="http/controller.php"> <!-- edit form -->
                                              <div class="row">
                                                  <input type="hidden" name="id" value="<?php echo $contact['id'];?>">
                                                  <div class ="col-lg-12 form-item" >
                                                      <label>First Name <input type="text" name="first_name" placeholder="Enter First Name" value="<?php echo $contact['first_name'];?>" /></label>
                                                  </div>

                                                   <div class="col-lg-12 form-item">
                                                      <label>Last Name <input type="text" name="last_name" placeholder="Enter Last Name" value="<?php echo $contact['last_name'];?>" /></label>
                                                  </div>
                                              </div>

                                              <div class="row">
                                                  <div class="col-lg-4 form-item">
                                                      <label>Phone Number <input type="text" name="phone_num" placeholder="Enter Phone Number" value="<?php echo $contact['phone_num'];?>"></label>
                                                  </div>
                                                  <div class="col-lg-4 form-item">
                                                      <label>Email <input type="email" name="email" placeholder="Enter Email" value="<?php echo $contact['email'];?>"> </label>
                                                  </div>

                                                  <div class="col-lg-6 form-item">
                                                      <label>Contact Group
                                                          <select name="contact_group">
                                                              <option value="Family" <?php if($contact['contact_group'] === 'Family'){echo 'selected';}?> >Family</option>
                                                              <option value="Friend" <?php if($contact['contact_group'] === 'Friend'){echo 'selected';}?> >Friend</option>
                                                              <option value="Business" <?php if($contact['contact_group'] === 'Business'){echo 'selected';}?> >Business</option>
                                                          </select>
                                                      </label>
                                                  </div>
                                              </div>

                                              <div class="col-lg-12 form-item">
                                                  <label><p>Notes</p><input name="notes" type"textarea" placeholder="Enter optional note" value="<?php echo $contact['notes'] ;?>" >
                                                  </label>
                                              </div>
                                               <!--modal footer-->
                                              <div class="modal-footer">
                                              <input name="update" type="submit" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal" style=" margin-top: 30px;">
                                            </div>
                                        </form>
                         				</div>
                     			      </div>
                     			    </div>
                     			  </div><!--End of modal-->

                            </td> <!--end of edit button-->
							<td><a href="http/controller.php?delete=<?php echo $contact['id'];?>" class="btn btn-danger bt">Delete</a></td>
						</tr>
					</tbody>
                    <?php
                    }
                        } else {
                            echo "No record found";
                        }
                    ?>

				</table>
			</div>
		</div>

	</div>
</div>

<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
