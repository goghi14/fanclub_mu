				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN .panel -->
						<div class="panel">
						
							<h2 style="margin-left: 22%;">Detaliile personale</h2>
							<div class="edit-user-panel">
								<form enctype="multipart/form-data" action="<?php echo base_url();?>users/edit_details" method="post">
									<input type="hidden" name="id" value="<?php echo($getUser->id); ?>" />
									<input type="hidden" name="curAvatar" value="<?php echo($getUser->avatar); ?>" />
									<table>
										<tr>
										<td><label>Nume, Prenume:</label></td>
										<td><input type="text" name="name" value="<?php echo($getUser->name); ?>" /></td>
										</tr>
										<tr>
										<td><label>Data nasterii:</label></td>
										<td><input type="text" name="dob" value="<?php echo($getUser->dob); ?>" /></td>
										</tr>
										<tr>
										<td><label>Email:</label></td>
										<td><input type="text" name="email" value="<?php echo($getUser->email); ?>" /></td>
										</tr>
										<tr>
										<td><label>Avatar:</label></td>
										<td><input type="file" name="avatar" size="20" /></td>
										</tr>
										<tr>
										<td><label>Locul de trai:</label></td>
										<td><input type="text" name="living" value="<?php echo($getUser->living_place); ?>" /></td>
										</tr>
									</table>
									<input type="submit" name="submit_user_details" value="Salveaza" />
								</form>
							</div>
						</div>

					</div>

				</div>