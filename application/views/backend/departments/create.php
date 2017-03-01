<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Create Department</h3>
								</div>
								<div class="panel-body">

									<?php

									 //paparkan notice kalau ada validation error 

									if(validation_errors())
									{

									?>

									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Please fix the form error below
									</div>

									<?php } ?>
									
									<!-- open form -->

									<?php echo form_open('departments/create'); ?>

									<div class="form-group">
										
										<?php 

										echo form_label('Department Name', 'department_name');	
										echo form_input('department_name',set_value('department_name'),'class="form-control"');
										echo form_error('department_name', '<p class="text-danger">', '</p>');
										?>

									</div>

									<div class="form-group">
										
										<?php 

										echo form_label('Department Description', 'department_description');	
										echo form_textarea('department_description',set_value('department_description'),'class="form-control"');
										echo form_error('department_description', '<p class="text-danger">', '</p>');
										?>

									</div>


									<button type="submit" class="btn btn-warning">Submit</button>

									<a href="<?php echo site_url('departments/index'); ?>" class="btn btn-default">Cancel</a>



									<?php echo form_close(); ?>

									<!-- end form -->
									
								</div>
							</div>